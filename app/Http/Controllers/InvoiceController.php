<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Shipment;
use App\Models\User;
use App\Traits\Invoices;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index(): View
    {
        $user_id = auth()->user()->id;
        $invoices = DB::table('invoices')
        ->join('shipments', 'invoices.shipment_id', '=', 'shipments.id')
        ->join('users', 'shipments.user_id', '=', 'users.id')
        ->select('invoices.*')
        ->where('users.id', $user_id)
        ->get();
        return view('invoices.invoice_overview', compact('invoices'));
    }
    public function nav_pay($invoiceId)
    {
        $invoice = Invoice::find($invoiceId);
        return view('invoices.payment', compact('invoice'));
    }
    public function pay($invoiceId){

        $affected = DB::table('invoices')
        ->where('id', $invoiceId)
        ->update(['is_paid' => 1]);
        return view('invoices.payment_success');
    }
    public function pdf(){

    }
}   