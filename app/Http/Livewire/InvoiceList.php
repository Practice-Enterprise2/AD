<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InvoiceList extends Component
{
    public $search = '';

    public $isPaid = 'both';

    public $comboArray = [];

    public function createArray($search)
    {
        if ($this->isPaid == 'both') {
            $invoices = DB::table('invoices')->where('invoice_code', 'LIKE', '%'.$search.'%')->get();
        }
        if ($this->isPaid == 'yes') {
            $invoices = DB::table('invoices')->where('invoice_code', 'LIKE', '%'.$search.'%')->where('is_paid', '1')->get();
        }
        if ($this->isPaid == 'no') {
            $invoices = DB::table('invoices')->where('invoice_code', 'LIKE', '%'.$search.'%')->where('is_paid', '0')->get();
        }

        for ($i = 0; $i < count($invoices); $i++) {
            $shipment = DB::table('shipments')->where('id', $invoices[$i]->shipment_id)->first();
            $user = DB::table('users')->where('id', $shipment->user_id)->first();
            $comboArray[$i]['id'] = $invoices[$i]->id;
            $comboArray[$i]['shipment_id'] = $invoices[$i]->shipment_id;
            $comboArray[$i]['invoice_code'] = $invoices[$i]->invoice_code;
            $comboArray[$i]['due_date'] = $invoices[$i]->due_date;
            $comboArray[$i]['total_price'] = $invoices[$i]->total_price;
            $comboArray[$i]['excl_vat'] = $invoices[$i]->total_price_excl_vat;
            $comboArray[$i]['is_paid'] = $invoices[$i]->is_paid;
            $comboArray[$i]['created_at'] = $invoices[$i]->created_at;
            $comboArray[$i]['name'] = $user->name;
            $comboArray[$i]['last_name'] = $user->last_name;
        }

        return $comboArray;
    }

    public function render()
    {
        return view('livewire.invoice-list', [
            'invoices' => InvoiceList::createArray($this->search),
        ]);
    }
}
