<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class contactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(Auth::user()->role == 1)
        {
            return view('contact.index', [
                'contacts' => contact::get()
            ]);
        }
        return Redirect(route('shipment.index'));
        
            
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
            'email' => $request->email,
            'shipment_id' => $shipment_id,
            'subject' => $request->subject,
            'message' => $request->message
        ]);
        return Redirect(route('shipment.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $contact = contact::where('id', $id)->first();
        if(contact::where('id', $id)->exists() && Auth::user()->role == 1)
        {
            return view('contact.show', [
                'contact' => $contact
            ]);
        }
        else
        {
            return redirect(route('shipment.index'));
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
        if(contact::where('id', $id)->exists() && Auth::user()->role == 1)
        {
            contact::destroy($id);
            return redirect(route('contact.index'));
        }
        return redirect(route('shipment.index'));
    }
}
