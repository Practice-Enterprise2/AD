<?php

namespace App\Http\Controllers;

use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class PayslipController extends Controller
{
    private function getDays($startDate, $endDate){
        // found: https://stackoverflow.com/questions/336127/calculate-business-days

        $endDate = strtotime($endDate);
        $startDate = strtotime($startDate);
    
        $days = ($endDate - $startDate) / 86400 + 1;
    
        $no_full_weeks = floor($days / 7);
        $no_remaining_days = fmod($days, 7);
    
        $the_first_day_of_week = date("N", $startDate);
        $the_last_day_of_week = date("N", $endDate);
    
        if ($the_first_day_of_week <= $the_last_day_of_week) {
            if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
            if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
        }
        else {
            if ($the_first_day_of_week == 7) {
                $no_remaining_days--;
    
                if ($the_last_day_of_week == 6) {
                    $no_remaining_days--;
                }
            }
            else {
                $no_remaining_days -= 2;
            }
        }
    
       $days = $no_full_weeks * 5;
        if ($no_remaining_days > 0 )
        {
          $days += $no_remaining_days;
        }
    
        return $days;
    }

    private function takenAbsence($abcense, $firstDate, $lastDate)
    {
        $startDate = $abcense->start_date;
        $endDate = $abcense->end_date;

        if ($startDate < $firstDate)
        {
            $startDate = $firstDate;
        }
        if ($endDate > $lastDate)
        {
            $endDate = $lastDate;
        }

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
    private function taxes($taxableIncome) {
        $taxableIncomeYear = $taxableIncome * 12;

        if ($taxableIncomeYear > 46440)
        {
            $tax50 = $taxableIncomeYear - 46440;

            $taxesYear = $this->tax25(15200);
            $taxesYear += $this->tax40(11630);
            $taxesYear += $this->tax45(19610);
            $taxesYear += $this->tax50($tax50);
        }
        elseif ($taxableIncomeYear > 26830)
        {
            $tax45 = $taxableIncomeYear - 26830;

            $taxesYear = $this->tax25(15200);
            $taxesYear += $this->tax40(11630);
            $taxesYear += $this->tax45($tax45);
        }
        elseif ($taxableIncomeYear > 15200)
        {
            $tax40 = $taxableIncomeYear - 15200;

            $taxesYear = $this->tax25(15200);
            $taxesYear += $this->tax40($tax40);
        }
        else
        {
            $taxesYear = $this->tax25($taxableIncomeYear);
        }
        $taxes = $taxesYear / 12;

        return $taxes;
    }



    
    public function calculateSendPayslip(Request $req)
    {
        $employees = DB::select('SELECT * FROM employees WHERE deleted_at IS NULL');

        foreach ($employees as $employee)
        {
            $employee_id = $employee->id;
            $employeeContract = DB::table('employee_contracts')
                                ->where('employee_id', $employee_id)
                                ->where(function($query) {
                                    $now = Carbon::now()->toDateString();

                                    $query->WhereNull('end_date')
                                    ->orwhereDate('end_date', '>=', $now);
                                })
                                ->first();
            $contract_id = $employeeContract->id;

            $lastdayForTaken = Carbon::now()->subMonthNoOverflow()->day(24)->endOfDay();
            $startYear = Carbon::now()->startOfYear();

            $takenAbsences = DB::table('absences')
                                    ->where('contract_id', 2)//$contract_id)
                                    ->where('status', 'taken')
                                    ->where('approval_time', '<=', $lastdayForTaken)
                                    ->where('end_date', '>=', $startYear)
                                    ->get();

            $takenHolidays = 0;
            $takenSickdays = 0;
            $firstDate = Carbon::now()->startOfYear();
            $lastDate = Carbon::now()->endOfYear();

            foreach ($takenAbsences as $takenAbsence)
            {
                if ($takenAbsence->type == 'holiday') {
                    $takenHolidays = $takenHolidays + $this->takenAbsence($takenAbsence, $firstDate, $lastDate);
                } else {
                    $takenSickdays = $takenSickdays + $this->takenAbsence($takenAbsence, $firstDate, $lastDate);
                }
            }
            error_log('takenH: '.$takenHolidays);
            error_log('takenS: '.$takenSickdays);

            $startMonth = Carbon::now()->startOfMonth();
            $endMonth = Carbon::now()->endOfMonth()->toDateString();
            $absencesThisMonth = DB::table('absences')
                                    ->where('contract_id', 2)//$contract_id)
                                    ->where('start_date', '<=', $endMonth)
                                    ->where('end_date', '>', $lastdayForTaken->toDateString())
                                    ->where(function($query) {
                                        $query->where('status', 'taken')
                                        ->orWhere('status', 'approved');
                                    })
                                    ->get();

            $unaccountedHolidays = 0;
            $unaccountedSickdays = 0;
            $holidays = 0;
            $sickdays = 0;

            foreach ($absencesThisMonth as $absence)
            {
                if ($absence->start_date > $lastdayForTaken->toDateString() && $absence->start_date < $startMonth->toDateString() && $absence->approval_time > $lastdayForTaken)
                {
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
            error_log('unaccountedH: '.$unaccountedHolidays."\tH: ".$holidays);
            error_log('unaccountedS: '.$unaccountedSickdays."\tS: ".$sickdays);

            if (Carbon::now()->format('M') == 'Jan') {
                $totalHolidays = $takenHolidays + $holidays;
                $totalSickdays = $takenSickdays + $sickdays;
            } else {
                $totalHolidays = $takenHolidays + $unaccountedHolidays + $holidays;
                $totalSickdays = $takenSickdays + $unaccountedSickdays + $sickdays;
            }
            error_log('totalH: '.$totalHolidays);
            error_log('totalS: '.$totalSickdays);

            $allowedAbsences = DB::table('holiday_saldos')
                                    ->where('contract_id', 2)//$contract_id)
                                    ->where('year', Carbon::now()->format('Y'))
                                    ->get();

            foreach ($allowedAbsences as $allowedAbsence)
            {
                if ($allowedAbsence->type == 'holiday') {
                    $remainingHolidays = $allowedAbsence->allowed_days - $totalHolidays;
                } else {
                    $remainingSickdays = $allowedAbsence->allowed_days - $totalSickdays;
                }
            }
            error_log('remainingH: '.$remainingHolidays);
            error_log('remainingS: '.$remainingSickdays);

            return

            $grossSalary = $employee->salary;

            //nss calculation -> rsz berekening         #-- https://www.jobat.be/nl/art/hoeveel-bedraagt-de-rsz --#
            $nss = $grossSalary * 1.08;
            $nssToPay = $nss * 0.1307;
            $taxableIncome = $grossSalary - $nssToPay;

            //withholding tax -> bedrijfsvoorheffing    #-- https://www.wikifin.be/nl/belasting-werk-en-inkomen/belastingaangifte/hoe-wordt-je-belasting-berekend --#
            $taxes =$this->taxes($taxableIncome);
            $netEarnings = $taxableIncome - $taxes;

            //calculate working days and hours
            $workingDays = $this->getWorkingDays();
            $workingHours = $workingDays * 7.0;

            //payslip in pdf
            $data = [
                'payDate' => date('d/m/Y'),
                'workingDays' => round($workingDays, 1),
                'workingHours' => round($workingHours, 1),
                'grossEarnings' => round($grossSalary, 2),
                'nss' => round($nssToPay, 2),
                'taxableIncome' => round($taxableIncome, 2),
                'taxes' => round($taxes, 2),
                'IBAN' => $employee->IBAN,
                'netEarnings' => round($netEarnings, 2)
            ];
              
            $pdf = PDF::loadView('payslip', $data);
            Storage::put('storage/pdf/payslip'.date('m-Y').'.pdf', $pdf->output());

            //send mail with payslip
            $mail = $employee->email;
            $name = $employee->first_name.' '.$employee->last_name;

            $data = [
                'email' => $mail,
                'name' => $name
            ];

            Mail::send(['mail'=>'mail.test_mail'], $data, function($message) use ($mail, $name) {
                $message->to($mail, $name)
                        ->subject('payslip '.date('d/m/Y'))
                        ->text("Dear employee,\n\nIn the attachments you can find your payslip for the past month.\n\nRegards,\nYour HR team");
                $message->attach(storage_path().'\app\storage\pdf\payslip'.date('m-Y').'.pdf');
                $message->from('hr@BlueSkyUnlimited.com', 'HR');
            });

            //delete payslip
            if(Storage::exists('storage/pdf/payslip'.date('m-Y').'.pdf')) {
                Storage::delete('storage/pdf/payslip'.date('m-Y').'.pdf');
            }
        }
    }
}
//C:\Users\marti\payslip\storage\app\