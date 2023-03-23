<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    //
    public function showForm(){
        return view('create-ticket');
    }

    public function store (Request $request){
        $validatedData = $request->validate([
            'cstID' => 'required',
            'issue' => 'required|max:64',
            'description' => 'required'
        ]);

        // create ticket
        $ticket = new Ticket;
        $ticket->cstID = $validatedData['cstID'];
        $ticket->issue = $validatedData['issue'];
        $ticket->description = $validatedData['description'];
        $ticket->save();

        return redirect()->route('show-ticket')->with( ['ticket' => $ticket]);
    }

    public function showSubmittedTicket()
    {
        $ticket = session('ticket');

        return view('submitted-ticket', ['ticket' => $ticket]);
    }
}
