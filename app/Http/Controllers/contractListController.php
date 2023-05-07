<?php

namespace App\Http\Controllers;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\contractList;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Contract;

use Illuminate\View\View;

class contractlistcontroller extends Controller
{
    public function contract_pdf($id){

        $contract = Contract::find($id);
        $pdf = Pdf::loadView('pdf', compact('contract'));
        return $pdf->download('contract.pdf');
    }
    public function contractFiltering(Request $request)
    {
        $filter = $request->query('filter');
        // $filter1 = $request->query('filter1');
        // $filter2 = $request->query('filter2');
        // $start_date = $request->query('start_date');
        // $end_date = $request->query('end_date');
        if (!empty($filter)) {
            $contracts = contractlist::sortable()
                ->where('id', 'like', '%'.$filter.'%','or','airline_id', 'like', '%'.$filter.'%','or','depart_airport_id', 'like', '%'.$filter.'%','or','destination_airport_id', 'like', '%'.$filter.'%')
                
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