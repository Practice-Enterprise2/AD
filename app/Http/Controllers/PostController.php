<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\Ticket;

class PostController extends Controller
{
    //
    public function ticketsubmit()
    {
        return view('ticketsubmit');
    }

    public function store(Request $request)
    {
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
    }
}
