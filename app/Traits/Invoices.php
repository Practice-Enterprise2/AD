<?php
namespace App\Traits;
use App\Models\Invoice;
use App\Models\Address;
use App\Models\Dimensions;
use App\Models\Shipment;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\DB;

trait Invoices{

    public function generateInvoice(){
        $lastShipment = Shipment::orderBy('id', 'desc')->first();       
        $volumetric_freight = 0;
        $volumetric_freight_tarrif = 5;
        $dense_cargo_tarrif = 4;
        $VAT_percentage = 0.21;
        $width = DB::table('dimensions')->where('id', '=', $lastShipment->dimension_id)->value('width');
        $height = DB::table('dimensions')->where('id', '=', $lastShipment->dimension_id)->value('height');
        $length = DB::table('dimensions')->where('id', '=', $lastShipment->dimension_id)->value('length');
        $volumetric_freight += (($length * $width * $height) / 5000);
        if ($volumetric_freight > $lastShipment->weight) {
            //Volumetric Air Freight rate
            $lastShipment->expense = $volumetric_freight * $volumetric_freight_tarrif;
        } else {
            //Dense Cargo rate
            $lastShipment->expense = $lastShipment->weight * $dense_cargo_tarrif;
        }

        $total_price = $lastShipment->expense;
        $total_price_excl_vat = $total_price * (1 - $VAT_percentage);
        $due_date = (new DateTime())->modify('+30 days');
        
        $invoice = Invoice::create([
            'shipment_id' => $lastShipment->id,
            'weight' => $lastShipment->weight,
            'due_date' => $due_date,
            'total_price' => $total_price,
            'total_price_excl_vat' => $total_price_excl_vat
        ]);
    }
    
}