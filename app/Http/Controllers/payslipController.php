<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class PayslipController extends Controller
{
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

    private function getWorkingDays(){
        $startDate = Carbon::now()->startOfMonth()->toDateString();
        $endDate = Carbon::now()->endOfMonth()->toDateString();

        // found: https://stackoverflow.com/questions/336127/calculate-business-days

        // do strtotime calculations just once
        $endDate = strtotime($endDate);
        $startDate = strtotime($startDate);
    
    
        //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
        //We add one to inlude both dates in the interval.
        $days = ($endDate - $startDate) / 86400 + 1;
    
        $no_full_weeks = floor($days / 7);
        $no_remaining_days = fmod($days, 7);
    
        //It will return 1 if it's Monday,.. ,7 for Sunday
        $the_first_day_of_week = date("N", $startDate);
        $the_last_day_of_week = date("N", $endDate);
    
        //---->The two can be equal in leap years when february has 29 days, the equal sign is added here
        //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
        if ($the_first_day_of_week <= $the_last_day_of_week) {
            if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
            if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
        }
        else {
            // (edit by Tokes to fix an edge case where the start day was a Sunday
            // and the end day was NOT a Saturday)
    
            // the day of the week for start is later than the day of the week for end
            if ($the_first_day_of_week == 7) {
                // if the start date is a Sunday, then we definitely subtract 1 day
                $no_remaining_days--;
    
                if ($the_last_day_of_week == 6) {
                    // if the end date is a Saturday, then we subtract another day
                    $no_remaining_days--;
                }
            }
            else {
                // the start date was a Saturday (or earlier), and the end date was (Mon..Fri)
                // so we skip an entire weekend and subtract 2 days
                $no_remaining_days -= 2;
            }
        }
    
        //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
    //---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it
       $workingDays = $no_full_weeks * 5;
        if ($no_remaining_days > 0 )
        {
          $workingDays += $no_remaining_days;
        }
    
        return $workingDays;
    }

    public function calculateSendPayslip(Request $req)
    {
        $employees = DB::select('select * from employees where is_active=1');

        foreach ($employees as $employee)
        {
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