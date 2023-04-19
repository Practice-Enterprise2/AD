<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceList extends Controller
{
    //
    public function index()
    {
        $invoices = array(array("Ben Van Damme","custID1", "generatedUniqueCodeXXXX", "250", "54", "Belgium", "Mechelen", "2800", "Merodestraat 246", "Poland", "Warschau", "54545", "Waschaustreet 20", "15-11-2023", "250", "10/04/2023"),
        array("Ben Van Damme","custID1", "generatedUniqueCodeXXYY", "450", "75", "Belgium", "Mechelen", "2800", "DeRing 111", "United Kingdom", "Londen", "84484", "Bigstreet 38", "1-12-2023", "450", "23/08/2023"), 
        array("Jan Janssens","custID2", "generatedUniqueCodeYYYY", "389", "68", "Belgium", "SKW", "2860", "Stationstraat", "Poland", "Warschau", "54545", "Waschaustreet 20", "15-11-2023", "250", "10/04/2023"));
        return view('invoiceslist', ['invoices' => $invoices]);
    }
}
