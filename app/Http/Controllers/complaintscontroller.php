<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\chatBox;
use App\Models\messages;
use App\Models\contact;

use Illuminate\Support\Facades\Auth;



class complaintscontroller extends Controller
{
    public function messages(){
        $chatbox = chatBox::where('customer_id', Auth::user()->id)->orWhere('employee_id', Auth::user()->id)->get();
        return view('complaints.messages', [
            'chatboxs' => $chatbox
        ]);
    }
    public function createChat($id){
        if(Auth::user()->role == 1)
        {
            $contact = contact::where('id', $id)->first();
            $chatbox = chatBox::where('customer_id', $contact->customer_id)
            ->where('employee_id', Auth::user()->id)
            ->first();

            if(!$chatbox)
            {
                $chatbox = chatBox::create([
                    'customer_id' => $contact->customer_id,
                    'employee_id' => Auth::user()->id
                ]);
            }
            $content = 'Contact: ' . $contact->email . "<br>" .
           'shipment_id: ' . $contact->shipment_id . "<br>" .
           'Subject: ' . $contact->subject . "<br>" .
           'message: ' . $contact->message;
           
            messages::create([
                'chatbox_id' => $chatbox->id,
                'from_id' => Auth::user()->id,
                'content' => $content
            ]);
            $contact->is_handled = 1;
            $contact->save();
            return Redirect(route('complaints.messages'));
        }
    }
    public function viewChat($id)
    {
        
        if (chatBox::where('id', $id)
            ->where(function ($query) {
                $query->where('customer_id', Auth::user()->id)
                    ->orWhere('employee_id', Auth::user()->id);
            })->exists()) {

    $messages = messages::where('chatbox_id', $id)
                 ->orderBy('created_at', 'asc')
                 ->get();

    return response()->json($messages);
    }
    else
    {
        return response(500);
    }
    }

}
