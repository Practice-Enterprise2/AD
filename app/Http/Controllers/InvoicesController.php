<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB ;
class InvoicesController extends Controller
{
    public function viewAllInvoices()
    {
        /* $invoices = array(array("Ben Van Damme","custID1", "generatedUniqueCodeXXXX", "250", "54", "Belgium", "Mechelen", "2800", "Merodestraat 246", "Poland", "Warschau", "54545", "Waschaustreet 20", "15-11-2023", "250", "10/04/2023"),
        array("Ben Van Damme","custID1", "generatedUniqueCodeXXYY", "450", "75", "Belgium", "Mechelen", "2800", "DeRing 111", "United Kingdom", "Londen", "84484", "Bigstreet 38", "1-12-2023", "450", "23/08/2023"), 
        array("Jan Janssens","custID2", "generatedUniqueCodeYYYY", "389", "68", "Belgium", "SKW", "2860", "Stationstraat", "Poland", "Warschau", "54545", "Waschaustreet 20", "15-11-2023", "250", "10/04/2023"));
        return view('invoiceslist', ['invoices' => $invoices]); */
        $invoices = DB::table('invoices')->get();

        return view('invoiceslist', ['invoices' => $invoices]);
    }
    public function viewInvoiceDetails(Request $req)
    {
        $invoiceID = $req->invoiceID;
        $invoice = DB::table('invoices')->where('id', $invoiceID)->first();
        $shipment = DB::table('shipments')->where('id', $invoice->shipment_id)->first();
        $sourceAddress = DB::table('addresses')->where('id', $shipment->source_address_id)->first();
        $destAddress = DB::table('addresses')->where('id', $shipment->destination_address_id)->first();
        $dimensions = DB::table('dimensions')->where('id', $shipment->dimension_id)->first();
        $user = DB::table('users')->where('id', $shipment->user_id)->first();

        $data = array();
        $data["invoice"] = $invoice;
        $data["shipment"] = $shipment;
        $data["dimensions"] = $dimensions;
        $data["user"] = $user;
        $data["sourceAddress"] = $sourceAddress;
        $data["destAddress"] = $destAddress; 

        return view('invoices_details', ['data' => $data]);
    }
}
