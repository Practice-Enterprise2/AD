<?php

namespace App\Traits;

use App\Models\Invoice;
use App\Models\Shipment;
use DateTime;
use Illuminate\Support\Facades\DB;

trait Invoices
{
    public function generateUniqueCode()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 6;

        $code = '';

        while (strlen($code) < 6) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }
        $invoices = [DB::table('invoices')->select('invoice_code')->value('invoice_code')];
        if ($invoices != null || count($invoices) <= 1) {
            if (in_array($code, $invoices)) {
                $this->generateUniqueCode();
            }
        }

        return $code;
    }

    public function generateInvoice()
    {
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

        $invoice = new Invoice([
            'weight' => $lastShipment->weight,
            'due_date' => $due_date,
            'total_price' => $total_price,
            'total_price_excl_vat' => $total_price_excl_vat,
            'invoice_code' => $this->generateUniqueCode(),
        ]);
        $invoice->shipment()->associate($lastShipment);
        $invoice->save();
    }
}
