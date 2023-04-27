<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class contactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

            return view('contact.index', [
                'contacts' => contact::where('is_handled', 0)->get(),
            ]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'email' => 'email|required',
            'shipment_id' => 'numeric|nullable',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $shipment_id = $request->filled('shipment_id') ? $request->shipment_id : 0;
        contact::create([
            'customer_id' => Auth::user()->id,
            'email' => $request->email,
            'shipment_id' => $shipment_id,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_handled' => 0,
        ]);

        return Redirect(route('complaints.messages'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $contact = contact::where('id', $id)->first();
        if (contact::where('id', $id)->exists() ) {
            return view('contact.show', [
                'contact' => $contact,
            ]);
        } else {
            return redirect(route('complaints.messages'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $contact = contact::where('id', $id)->first();
        if (contact::where('id', $id)->exists()) {
            contact::destroy($id);

            return redirect(route('contact.index'));
        }

        return redirect(route('complaints.messages'));
    }
}
