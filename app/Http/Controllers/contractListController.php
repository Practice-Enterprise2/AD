<?php

namespace App\Http\Controllers;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\contractList;

use Illuminate\View\View;

class contractlistcontroller extends Controller
{
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
       $contracts = DB::select('select * from contracts c INNER JOIN airports a ON c.depart_location = a.iataCode INNER JOIN airlines al ON c.airline_ID = al.id WHERE c.active = 1');
       return view('contract_list',['contracts'=>$contracts]);
    }
}
