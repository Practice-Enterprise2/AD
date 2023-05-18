<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InvoiceList extends Component
{
    public $search = '';
    public $isPaid = 'both';
    
    public function render()
    {
        if($this->isPaid == "both")
        {
            return view('livewire.invoice-list', [
                'invoices' => DB::table('invoices')->where('invoice_code', 'LIKE', '%'.$this->search.'%')->get(),
            ]);
        }
        if($this->isPaid == "yes"){
            return view('livewire.invoice-list', [
                'invoices' => DB::table('invoices')->where('invoice_code', 'LIKE', '%'.$this->search.'%')->where('is_paid', '1')->get(),
            ]);
        }
        if($this->isPaid == "no"){
            return view('livewire.invoice-list', [
                'invoices' => DB::table('invoices')->where('invoice_code', 'LIKE', '%'.$this->search.'%')->where('is_paid', '0')->get(),
            ]);
        }
    }
}
