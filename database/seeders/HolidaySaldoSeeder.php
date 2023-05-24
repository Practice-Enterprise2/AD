<?php

namespace Database\Seeders;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HolidaySaldoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contracts =  DB::table("employee_contracts")->get();

        for($i = 0; $i<count($contracts); $i++)
        {
            
            $startDate = $contracts[$i]->start_date;
            $endDate = $contracts[$i]->end_date;
            $startdate = new DateTime($startDate);
            $stopdate = new DateTime($endDate);

            $daysInStartYear = (clone $startdate)->modify('last day of December')->diff($startdate)->days;
            $daysInEndYear = (clone $stopdate)->modify('first day of January')->diff($stopdate)->days;

            $startyear = intval($startDate.substr(0, 4));
            $stopyear = intval($endDate.substr(0, 4));

            for ($b = $startyear; $b <= $stopyear; $b++) {
                if($b == $startyear)
                {
                    DB::table('holiday_saldos')->insert([
                        'employee_contract_id' => $contracts[$i]->id,
                        'allowed_days' => random_int(0, $daysInStartYear/4),
                        'year' => $b,
                        'type' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
                elseif($b == $stopyear)
                {
                    DB::table('holiday_saldos')->insert([
                        'employee_contract_id' => $contracts[$i]->id,
                        'allowed_days' => random_int(0, $daysInEndYear/4),
                        'year' => $b,
                        'type' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
                else
                {
                    DB::table('holiday_saldos')->insert([
                        'employee_contract_id' => $contracts[$i]->id,
                        'allowed_days' => random_int(0, 50),
                        'year' => $b,
                        'type' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }
    }
}
