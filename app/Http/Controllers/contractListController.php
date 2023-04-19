<?php

namespace App\Http\Controllers;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\contractList;
use Barryvdh\DomPDF\Facade as PDF;


use Illuminate\View\View;

class contractlistcontroller extends Controller
{
    public function contract_pdf(Request $request){
        $data = [$request->contract_ID ,$request->airline_ID ,$request->start_date,$request->end_date,
        $request->price,$request->depart_airport, $request->destination_airport];
        $pdf = PDF::loadView('pdf', $data);
        return $pdf->download('contract.pdf');
    }
    public function contractFiltering(Request $request)
    {
        $filter = $request->query('filter');
    
        if (!empty($filter)) {
            $contracts = contractlist::sortable()
                ->where('airline_id', 'like', '%'.$filter.'%')
                ->paginate(15);
        } else {
            $contracts = contractlist::sortable()
                ->paginate(15);
        }
        
        return view('contract_list', ['contracts' => $contracts]);
    }
    public function index()
    {
       //$contracts = DB::select('select * from contracts c INNER JOIN airports a ON c.depart_location = a.iataCode INNER JOIN airlines al ON c.airline_ID = al.id WHERE c.active = 1');
       $contracts = DB::select('select * from contracts c INNER JOIN airports a ON c.depart_location = a.id INNER JOIN airlines al ON c.airline_id = al.id');
       return view('contract_list',['contracts'=>$contracts]);
    }
}
