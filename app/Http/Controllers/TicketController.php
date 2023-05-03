<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class TicketController extends Controller
{
    public function showForm(): View
    {
        return view('create-ticket');
    }

    public function store(Request $request): Redirector|RedirectResponse
    {
        $validatedData = $request->validate([
            'cstID' => 'required',
            'issue' => 'required|max:64',
            'description' => 'required',
        ]);

        // create ticket
        $ticket = new Ticket();
        $ticket->cstID = $validatedData['cstID'];
        $ticket->issue = $validatedData['issue'];
        $ticket->description = $validatedData['description'];
        $ticket->save();

        return redirect()->route('show-ticket')->with(['ticket' => $ticket]);
    }

    public function showSubmittedTicket(): View
    {
        $ticket = session('ticket');

        return view('submitted-ticket', ['ticket' => $ticket]);
    }
}
