<?php

namespace App\Http\Controllers;




use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Contract;
use Illuminate\View\View;

class contractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
       $contracts = DB::select('select * from contracts c INNER JOIN airports a ON c.depart_airport = a.iataCode INNER JOIN airlines al ON c.airline_ID = al.id WHERE c.active = 1');
       return view('test',['contracts'=>$contracts]);
    }

    public function alter()
    {
        $id = $_GET["id"];
        $airlineCode = $_GET["airline"];
        $start_date = $_GET["start_date"];
        $end_date = $_GET["end_date"];
        $price = $_GET["price"];
        $departure = $_GET["departure_airport"];
        $destination = $_GET["destination_airport"];

        $affected = DB::table('contracts')->where('contract_ID',$id)->update(
            ['airline_ID'=> $airlineCode,'start_date' => $start_date, 'end_date' => $end_date, 'price'=>$price,'depart_airport'=>$departure,'destination_airport'=>$destination]);
            if (isset($_GET["remove"]))
            {
                $affected = DB::table('contracts')->where('contract_ID',$id)->update(
                    ['active'=> 0]);
            }
           unset($_GET);
           ?>
           <script>
            this.location.replace("/contract");
           </script>
           <?php
    }
    public function simpleIndex()
    {
        $id = 1;
        $contracts = null;
        if (!isset($_GET["q"]))
        {
           // $contracts = DB::select("select * from contracts c INNER JOIN airports a ON c.depart_airport = a.code INNER JOIN airlines al ON c.airline_ID = al.id WHERE c.active = 1 limit 1");
           $contracts = DB::select("select * from contracts c INNER JOIN airports a ON c.depart_airport = a.iataCode INNER JOIN airports a2 ON c.destination_airport = a2.iataCode
           INNER JOIN airlines al on c.airline_ID = al.id where c.active = 1 limit 1");
        }
        else
        {
            if ($_GET["q"] == null)
            {

            }
            elseif(is_numeric($_GET["q"]))
            {
                $id = $_GET["q"];
                $id = htmlspecialchars($id);
            }
            else
            {
                $id = $_GET["q"];
                $id = htmlspecialchars($id);
                $id = int($id);
            }
           // $contracts = DB::select("select * from contracts c INNER JOIN airports a ON c.depart_airport = a.code INNER JOIN airlines al ON c.airline_ID = al.id WHERE c.active = 1 and contract_ID = $id");
           $contracts = DB::select("select * from contracts c INNER JOIN airports a ON c.depart_airport = a.iataCode INNER JOIN airports a2 ON c.destination_airport = a2.iataCode
           INNER JOIN airlines al on c.airline_ID = al.id where c.active = 1 and c.contract_ID = $id");
           if (count($contracts) != 1)
            {
               // $contracts = DB::select("select * from contracts c INNER JOIN airports a ON c.depart_airport = a.code INNER JOIN airlines al ON c.airline_ID = al.id WHERE c.active = 1 limit 1");
               $contracts = DB::select("select * from contracts c INNER JOIN airports a ON c.depart_airport = a.iataCode INNER JOIN airports a2 ON c.destination_airport = a2.iataCode
               INNER JOIN airlines al on c.airline_ID = al.id where c.active = 1 limit 1");
            }
            }
            $airports = AirportController::getAirports();
            return view('contract',compact('contracts','airports'));
               // return  view('contract',['contracts'=>$contracts]);

        }
        public function specificContract($id)
        {
        $contracts = DB::select("SELECT ap.name, c1.contract_ID, c2.contract_ID
        FROM airports ap INNER JOIN
        contracts c1 ON ap.iataCode = c1.depart_airport INNER JOIN
        conctracts c2 ON ap.iataCode = c2.destination_airport
        GROUP BY ap.name
        HAVING ap.iataCode IN (SELECT c3.depart_airport as code FROM contracts c3 UNION SELECT c4.destination_airport as code FROM contracts c4)
                ");
        }
}
