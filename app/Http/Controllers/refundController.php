<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Mail;

use App\Models\refund;
use App\Mail\contactMail;
  
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
            'shipment_id' => 'required',
        ]);

            $data = array(
                'Firstname' => $request->Firstname,
                'Lastname' => $request->Lastname,
                'email' => $request->email,
                'shipment_id' => $request->shipment_id,
                'shipment_date' => $request->shipment_date,
                'subject' => $request->subject,
                'message1' => $request->message1,
                'image' => $request->image,
            );
            Log::info("data");
            Log::info($data);
        // Refund::create($request->all());
        $email = 'cptn989@gmail.com';
        Mail::to($email)->send(new \App\Mail\ContactMail($data));
        return redirect()->back()
                         ->with(['success' => 'Thank you for contacting us. we will contact you shortly.']);
    }
}