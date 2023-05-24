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

        if (!empty($filter)) {
            $contracts = contractlist::sortable()
                 ->where('id', 'like','%'.$filter.'%')
                 ->orwhere('depart_airport_id', 'like', '%'.$filter.'%')           
                 ->orwhere('airline_id', 'like', '%'.$filter.'%')         
                 ->orwhere('destination_airport_id','like','%'.$filter.'%')         
                ->paginate(15);
        } else {
            $contracts = contractlist::sortable()
                ->paginate(15);
        }

        return view('contract_list', ['contracts' => $contracts]);
    }
    public function index()
    {
       $contracts = DB::select('select * from contracts c INNER JOIN airports a ON c.depart_location = a.id INNER JOIN airlines al ON c.airline_id = al.id');
       return view('contract_list',['contracts'=>$contracts]);
    }
}
