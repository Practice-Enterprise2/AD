<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function ticketsubmit(): View
    {
        return view('ticketsubmit');
    }

    public function store(Request $request): void
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
    }
}
