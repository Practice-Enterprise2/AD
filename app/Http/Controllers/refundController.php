<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\refund;
  
class refundController extends Controller
{

    public function index()
    {
        return view('refund/create_refund');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Firstname' => 'required',
            'Lastname' => 'required',
            'email' => 'required|email',
            'shipment_id' => 'required|digits:10|numeric',
        ]);
  
        Refund::create($request->all());
  
        return redirect()->back()
                         ->with(['success' => 'Thank you for contacting us. we will contact you shortly.']);
    }
}