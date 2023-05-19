<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB ;
class InvoicesController extends Controller
{
    public function viewAllInvoices()
    {        
        return view('invoiceslist');
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
    public function invoiceMail(Request $req){
        
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

        Mail::send('invoices_details', ['data' => $data], function($message) use($data) {
            $message->to($data['user']->email, $data['user']->name.' '.$data['user']->last_name)->subject
                ('Invoice to be paid');
            $message->from('BlueSky@mail.com','BlueSky');
        });
        
        
    }
}
