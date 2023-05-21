<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerOrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        $search_query = $request->input('query');
        if ($search_query != null) {
            $search_query = (string) $search_query;
        }
        $comboArray = [];
        $userID = auth()->user()->id;
        if ($search_query == null) {
            $shipments = DB::table('shipments')->where('user_id', $userID)->get();
            for ($i = 0; $i < count($shipments); $i++) {
                $sourceAdd = DB::table('addresses')->where('id', $shipments[$i]->source_address_id)->first();
                $destAdd = DB::table('addresses')->where('id', $shipments[$i]->destination_address_id)->first();
                $invoice = DB::table('invoices')->where('shipment_id', $shipments[$i]->id)->first();
                $dimensions = DB::table('dimensions')->where('id', $shipments[$i]->dimension_id)->first();
                $comboArray[$i][0] = $shipments[$i];
                $comboArray[$i][1] = $invoice;
                $comboArray[$i][2] = $sourceAdd;
                $comboArray[$i][3] = $destAdd;
                $comboArray[$i][4] = $i;
                $comboArray[$i][5] = $dimensions;
            }
        } else {
            $invoices = DB::table('invoices')->where('invoice_code', 'LIKE', "%$search_query%")->get();
            for ($i = 0; $i < count($invoices); $i++) {
                $shipment = DB::table('shipments')->where('id', $invoices[$i]->shipment_id)->first();
                $sourceAdd = DB::table('addresses')->where('id', $shipment->source_address_id)->first();
                $destAdd = DB::table('addresses')->where('id', $shipment->destination_address_id)->first();
                $dimensions = DB::table('dimensions')->where('id', $shipment->dimension_id)->first();
                $comboArray[$i][0] = $shipment;
                $comboArray[$i][1] = $invoices[$i];
                $comboArray[$i][2] = $sourceAdd;
                $comboArray[$i][3] = $destAdd;
                $comboArray[$i][4] = $i;
                $comboArray[$i][5] = $dimensions;
            }
        }

        return view('customer_order_history', ['data' => $comboArray]);
    }
}
