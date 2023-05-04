<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;

class PayslipController extends Controller
{
    private function getDays($startDate, $endDate)
    {
        // found: https://stackoverflow.com/questions/336127/calculate-business-days
        //get days in a month minus holidays and weekends

        $endDate = strtotime($endDate);
        $startDate = strtotime($startDate);

        $days = ($endDate - $startDate) / 86400 + 1;

        $no_full_weeks = floor($days / 7);
        $no_remaining_days = fmod($days, 7);

        $the_first_day_of_week = date('N', $startDate);
        $the_last_day_of_week = date('N', $endDate);

        if ($the_first_day_of_week <= $the_last_day_of_week) {
            if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) {
                $no_remaining_days--;
            }
            if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) {
                $no_remaining_days--;
            }
        } else {
            if ($the_first_day_of_week == 7) {
                $no_remaining_days--;

                if ($the_last_day_of_week == 6) {
                    $no_remaining_days--;
                }
            } else {
                $no_remaining_days -= 2;
            }
        }

        $days = $no_full_weeks * 5;
        if ($no_remaining_days > 0) {
            $days += $no_remaining_days;
        }

        return $days;
    }

    private function takenAbsence($abcense, $firstDate, $lastDate)
    {
        $startDate = $abcense->start_date;
        $endDate = $abcense->end_date;

        //if startdate of absence is before the first possible day (say first day of the year) change the start day to the first possible day
        if ($startDate < $firstDate) {
            $startDate = $firstDate;
        }
        //if enddate of absence is before the last possible day (say last day of the year) change the start day to the last possible day
        if ($endDate > $lastDate) {
            $endDate = $lastDate;
        }

        //calculate the amount of days the absence was -> minus weekends and holidays
        $days = $this->getDays($startDate, $endDate);

        return $days;
    }

    private function tax25($taxable)
    {
        $taxes = $taxable * 0.25;

        return $taxes;
    }

    private function tax40($taxable)
    {
        $taxes = $taxable * 0.4;

        return $taxes;
    }

    private function tax45($taxable)
    {
        $taxes = $taxable * 0.45;

        return $taxes;
    }

    private function tax50($taxable)
    {
        $taxes = $taxable * 0.5;

        return $taxes;
    }

    private function taxes($taxableIncome)
    {
        //go trough the tax system
        $taxableIncomeYear = $taxableIncome * 12;

        if ($taxableIncomeYear > 46440) {
            $tax50 = $taxableIncomeYear - 46440;

            $taxesYear = $this->tax25(15200);
            $taxesYear += $this->tax40(11630);
            $taxesYear += $this->tax45(19610);
            $taxesYear += $this->tax50($tax50);
        } elseif ($taxableIncomeYear > 26830) {
            $tax45 = $taxableIncomeYear - 26830;

            $taxesYear = $this->tax25(15200);
            $taxesYear += $this->tax40(11630);
            $taxesYear += $this->tax45($tax45);
        } elseif ($taxableIncomeYear > 15200) {
            $tax40 = $taxableIncomeYear - 15200;

            $taxesYear = $this->tax25(15200);
            $taxesYear += $this->tax40($tax40);
        } else {
            $taxesYear = $this->tax25($taxableIncomeYear);
        }
        $taxes = $taxesYear / 12;

        return $taxes;
    }

    public function calculateSendPayslip()
    {
        //get all employees that are active from the database
        $employees = DB::select('SELECT * FROM employees WHERE deleted_at IS NULL');

        //go trough all employees
        foreach ($employees as $employee) {
            $employee_id = $employee->id;

            //get employee_contract from employee
            $employeeContract = DB::table('employee_contracts')
                ->where('employee_id', $employee_id)
                ->where(function ($query) {
                    $now = Carbon::now()->toDateString();

                    $query->WhereNull('end_date')
                        ->orwhereDate('end_date', '>=', $now);
                })
                ->first();
            $contract_id = $employeeContract->id;

            //get last possible day that an absence can be approved for this months payslip
            $lastdayForTaken = Carbon::now()->subMonthNoOverflow()->day(24)->endOfDay();
            $startYear = Carbon::now()->startOfYear();

            //get all absences that have been taken this year by the employee
            $takenAbsences = DB::table('absences')
                ->where('contract_id', $contract_id)
                ->where('status', 'taken')
                ->where('approval_time', '<=', $lastdayForTaken)
                ->where('end_date', '>=', $startYear)
                ->get();

            $takenHolidays = 0;
            $takenSickdays = 0;
            $firstDate = Carbon::now()->startOfYear();
            $lastDate = Carbon::now()->endOfYear();

            //get amount of days for each taken absence
            foreach ($takenAbsences as $takenAbsence) {
                if ($takenAbsence->type == 'holiday') {
                    $takenHolidays = $takenHolidays + $this->takenAbsence($takenAbsence, $firstDate, $lastDate);
                } else {
                    $takenSickdays = $takenSickdays + $this->takenAbsence($takenAbsence, $firstDate, $lastDate);
                }
            }

            $startMonth = Carbon::now()->startOfMonth();
            $endMonth = Carbon::now()->endOfMonth();

            //get all taken or approved absences this month and unaccounted ones from last month
            $absencesThisMonth = DB::table('absences')
                ->where('contract_id', $contract_id)
                ->where('start_date', '<=', $endMonth->toDateString())
                ->where('end_date', '>', $lastdayForTaken->toDateString())
                ->where(function ($query) {
                    $query->where('status', 'taken')
                        ->orWhere('status', 'approved');
                })
                ->get();

            $unaccountedHolidays = 0;
            $unaccountedSickdays = 0;
            $holidays = 0;
            $sickdays = 0;

            //for each absence this month, how many unaccounted and how many normal absences
            foreach ($absencesThisMonth as $absence) {
                if ($absence->start_date > $lastdayForTaken->toDateString() && $absence->start_date < $startMonth->toDateString() && $absence->approval_time > $lastdayForTaken) {
                    if ($absence->type == 'holiday') {
                        $unaccountedHolidays = $unaccountedHolidays + $this->takenAbsence($absence, $firstDate, $startMonth->subDay()->toDateString());
                        $holidays = $holidays - $unaccountedHolidays;
                    } else {
                        $unaccountedSickdays = $unaccountedSickdays + $this->takenAbsence($absence, $firstDate, $startMonth->subDay()->toDateString());
                        $sickdays = $sickdays - $unaccountedSickdays;
                    }

                    if ($absence->type == 'holiday') {
                        $holidays = $holidays + $this->takenAbsence($absence, $firstDate, $lastDate);
                    } else {
                        $sickdays = $sickdays + $this->takenAbsence($absence, $firstDate, $lastDate);
                    }
                } else {
                    if ($absence->type == 'holiday') {
                        $holidays = $holidays + $this->takenAbsence($absence, $firstDate, $lastDate);
                    } else {
                        $sickdays = $sickdays + $this->takenAbsence($absence, $firstDate, $lastDate);
                    }
                }
            }

            //get total amount of absences that have been taken or approved
            if (Carbon::now()->format('M') == 'Jan') {
                $totalHolidays = $takenHolidays + $holidays;
                $totalSickdays = $takenSickdays + $sickdays;
            } else {
                $totalHolidays = $takenHolidays + $unaccountedHolidays + $holidays;
                $totalSickdays = $takenSickdays + $unaccountedSickdays + $sickdays;
            }

            //posible working days for this month and last month
            $daysThis = $this->getDays($startMonth->toDateString(), $endMonth->toDateString());
            $daysLast = $this->getDays($startMonth->subMonth()->toDateString(), $endMonth->subMonth()->toDateString());

            //pay per day for this month and last month
            $payDayThis = $employee->salary / $daysThis;
            $payDayLast = $employee->salary / $daysLast;

            //get how many absences an employee gets paid
            $allowedAbsences = DB::table('holiday_saldos')
                ->where('contract_id', $contract_id)
                ->where('year', Carbon::now()->format('Y'))
                ->get();

            $unpaidAbsence = 0;

            //calculate how many unpaid absences the employee has taken
            foreach ($allowedAbsences as $allowedAbsence) {
                if ($allowedAbsence->type == 'holiday') {
                    if ($allowedAbsence->allowed_days < $totalHolidays) {
                        if (($totalHolidays - $allowedAbsence->allowed_days) > ($holidays + $unaccountedHolidays)) {
                            $unpaidHolidays = $holidays + $unaccountedHolidays;
                            $paidHolidays = 0;
                            $unpaidAbsence = $unpaidAbsence + ($holidays * $payDayThis) + ($unaccountedHolidays * $payDayLast);
                        } elseif (($totalHolidays - $allowedAbsence->allowed_days) > $holidays) {
                            $unpaidUnaccountedHolidays = $totalHolidays - $allowedAbsence->allowed_days - $holidays;
                            $paidHolidays = $unaccountedHolidays - $unpaidUnaccountedHolidays;
                            $unpaidAbsence = $unpaidAbsence + ($holidays * $payDayThis) + ($unpaidUnaccountedHolidays * $payDayLast);
                        } else {
                            $unpaidHolidays = $totalHolidays - $allowedAbsence->allowed_days;
                            $paidHolidays = ($holidays + $unaccountedHolidays) - $unpaidHolidays;
                            $unpaidAbsence = $unpaidAbsence + ($unpaidHolidays * $payDayThis);
                        }
                    } else {
                        $unpaidHolidays = 0;
                        $paidHolidays = $holidays + $unaccountedHolidays;
                    }
                } else {
                    if ($allowedAbsence->allowed_days < $totalSickdays) {
                        if (($totalSickdays - $allowedAbsence->allowed_days) > ($sickdays + $unaccountedSickdays)) {
                            $unpaidSickdays = $sickdays + $unaccountedSickdays;
                            $paidSickdays = 0;
                            $unpaidAbsence = $unpaidAbsence + ($sickdays * $payDayThis) + ($unaccountedSickdays * $payDayLast);
                        } elseif (($totalSickdays - $allowedAbsence->allowed_days) > $sickdays) {
                            $unpaidUnaccountedSickdays = $totalSickdays - $allowedAbsence->allowed_days - $sickdays;
                            $paidSickdays = $unaccountedSickdays - $unpaidUnaccountedSickdays;
                            $unpaidAbsence = $unpaidAbsence + ($sickdays * $payDayThis) + ($unpaidUnaccountedSickdays * $payDayLast);
                        } else {
                            $unpaidSickdays = $totalSickdays - $allowedAbsence->allowed_days;
                            $paidSickdays = ($sickdays + $unaccountedSickdays) - $unpaidSickdays;
                            $unpaidAbsence = $unpaidAbsence + ($unpaidSickdays * $payDayThis);
                        }
                    } else {
                        $unpaidSickdays = 0;
                        $paidSickdays = $sickdays + $unaccountedSickdays;
                    }
                }
            }

            //employee gross salary minus all unpaid absences from this month and the unaccounted from last month;
            $wage = $employee->salary;
            $grossSalary = $wage - $unpaidAbsence;

            //nss calculation -> rsz berekening         #-- https://www.jobat.be/nl/art/hoeveel-bedraagt-de-rsz --#
            $nss = $grossSalary * 1.08;
            $nssToPay = $nss * 0.1307;
            $taxableIncome = $grossSalary - $nssToPay;

            //withholding tax -> bedrijfsvoorheffing    #-- https://www.wikifin.be/nl/belasting-werk-en-inkomen/belastingaangifte/hoe-wordt-je-belasting-berekend --#
            $taxes = $this->taxes($taxableIncome);
            $netEarnings = $taxableIncome - $taxes;

            //calculate days and hours worked
            $workingDays = $daysThis - ($holidays + $sickdays);
            $workingHours = $workingDays * 7.0;

            //data for in pdf
            $data = [
                'payDate' => date('d/m/Y'),
                'workingDays' => round($workingDays, 1),
                'workingHours' => round($workingHours, 1),
                'paidHolidays' => round($paidHolidays, 1),
                'unpaidHolidays' => round($unpaidHolidays, 1),
                'paidSickdays' => round($paidSickdays, 1),
                'unpaidSickdays' => round($unpaidSickdays, 1),
                'wage' => round($wage, 2),
                'unpaidAbsence' => round($unpaidAbsence, 2),
                'grossSalary' => round($grossSalary, 2),
                'nss' => round($nssToPay, 2),
                'taxableIncome' => round($taxableIncome, 2),
                'taxes' => round($taxes, 2),
                'IBAN' => $employee->Iban,
                'netEarnings' => round($netEarnings, 2),
            ];

            //run -> composer require barryvdh/laravel-dompdf <- for it to work
            //create and store generated PDF file
            $pdf = PDF::loadView('pdf.payslip', $data);
            Storage::put('storage/pdf/payslip'.date('m-Y').'.pdf', $pdf->output());

            //get user account from employee
            $user = DB::table('users')
                ->where('id', $employee->user_id)
                ->first();
            $mail = $user->email;
            $name = $user->name.' '.$user->last_name;

            //data for the mail
            $data = [
                'email' => $mail,
                'name' => $name,
            ];

            //send mail with payslip in attachement
            Mail::send(['mail' => 'mail.test_mail'], $data, function ($message) use ($mail, $name) {
                $message->to($mail, $name)
                    ->subject('payslip '.date('d/m/Y'))
                    ->text('Dear '.$name.",\n\nIn the attachments you can find your payslip for the past month.\n\nRegards,\nYour HR team");
                $message->attach(storage_path().'\app\storage\pdf\payslip'.date('m-Y').'.pdf');
            });

            //delete PDF file
            if (Storage::exists('storage/pdf/payslip'.date('m-Y').'.pdf')) {
                Storage::delete('storage/pdf/payslip'.date('m-Y').'.pdf');
            }
        }
    }
}
