<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\refund;
use App\Mail\ContactMail;
  
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
                'message' => $request->message,
                'image' => $request->image,
            );
            Log::info("data");
            Log::info($data);
        // Refund::create($request->all());
        Mail::to('cptn989@gmail.com')->send(new ContactMail($data));
        return redirect()->back()
                         ->with(['success' => 'Thank you for contacting us. we will contact you shortly.']);
    }
}