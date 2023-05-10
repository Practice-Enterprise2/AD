<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractList;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Contractlistcontroller extends Controller
{
    public function contract_pdf($id)
    {

        $contract = Contract::find($id);
        $pdf = Pdf::loadView('pdf', compact('contract'));

        return $pdf->download('contract.pdf');
    }

    public function contractFiltering(Request $request)
    {
        $filter = $request->query('filter');
        $filter1 = $request->query('filter1');
        $filter2 = $request->query('filter2');

        if (! empty($filter)) {
            $contracts = contractlist::sortable()
                ->where('id', 'like', '%'.$filter.'%')
                ->paginate(15);
        } else {
            $contracts = contractlist::sortable()
                ->paginate(15);
        }
        if (! empty($filter1)) {
            $contracts = contractlist::sortable()
                ->where('depart_location', 'like', '%'.$filter1.'%')
                ->paginate(15);
        } else {
            $contracts = contractlist::sortable()
                ->paginate(15);
        }
        if (! empty($filter2)) {
            $contracts = contractlist::sortable()
                ->where('destination_location', 'like', '%'.$filter2.'%')
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

        return view('contract_list', ['contracts' => $contracts]);
    }
}