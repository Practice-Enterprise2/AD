<?php

namespace App\Http\Controllers;




use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Airline;
use App\Models\airport;
use App\Models\Contract;
use Illuminate\View\View;

class contractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $contracts = DB::select('select * from contracts c INNER JOIN airports a ON c.depart_airport = a.code INNER JOIN airlines al ON c.airline_ID = al.id WHERE c.active = 1');
       return view('contract',['contracts'=>$contracts]);
    }
    public function alter()
    {
        $id = $_GET["id"];
        $airlineID = $_GET["airline"];
        $start_date = $_GET["start_date"];
        $end_date = $_GET["end_date"];
        $price = $_GET["price"];
        $airportID = $_GET["airportID"];
        $departure = $_GET["departure_location"];
        $destination = $_GET["destination_location"];

        $affected = DB::table('contracts')->where('id',$id)->update(
            ['airline_id'=> $airlineID,'start_date' => $start_date, 'end_date' => $end_date, 'price'=>$price,'airport_id' =>$airportID,'depart_location'=>$departure,'destination_location'=>$destination]);
          /*  if (isset($_GET["remove"]))
            {
                $affected = DB::table('contracts')->where('id',$id)->update(
                    ['active'=> 0]);
            }
            elseif (isset($_GET["reactivate"]))
            {
                $affected = DB::table('contracts')->where('contract_ID',$id)->update(
                    ['active'=> 1]);
            } */
           unset($_GET);
           ?>
           <script>
            this.location.replace("/contract");
           </script>
           <?php
    }
    public function simpleV2()
    {
        $id = 1;
        $contracts = null;
        if (!isset($_GET["q"]))
        {
            $_GET["q"] = 1;
        }

            if (is_numeric($_GET["q"]))
            {
                $id = $_GET["q"];
            }
            $contracts = Contract::where('id',$id)->get();
            $airports = airport::all();
          //  $airlines = Airline::with('contract')->where('id',$contracts[0]->airline_id)->get();
            $airlines = Airline::all();
            return view('contract',compact('contracts','airports','airlines'));

    }
  /*  public function simpleIndex()
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
        */


}

