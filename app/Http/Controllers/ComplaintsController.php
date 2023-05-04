<?php

namespace App\Http\Controllers;

use App\Events\Complaint;
use App\Models\ChatBox;
use App\Models\ChatBoxMessages;
use App\Models\CustomerContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintsController extends Controller
{
    public function messages()
    {
        $chatbox = ChatBox::where('customer_id', Auth::user()->id)->orWhere('employee_user_id', Auth::user()->id)->get();

        return view('complaints.messages', [
            'chatboxs' => $chatbox,
        ]);
    }

    public function sendMessage(Request $request)
    {
        if (ChatBox::where('id', $request->id)
            ->where(function ($query) {
                $query->where('customer_id', Auth::user()->id)
                    ->orWhere('employee_user_id', Auth::user()->id);
            })->exists()) {
            $chatbox = ChatBox::where('id', $request->id)->get()->first();
            $chatboxMessages = new ChatBoxMessages();
            $chatboxMessages->chatbox_id = $chatbox->id;
            $chatboxMessages->from_id = Auth::user()->id;
            $chatboxMessages->content = $request->content;
            $chatboxMessages->save();
            event(new Complaint($request->content, $chatbox, Auth::user()));

            return Auth::user();
        }
    }

    public function createChat($id)
    {
        $contact = CustomerContact::where('id', $id)->first();
        $chatbox = ChatBox::where('customer_id', $contact->customer_id)
            ->where('employee_user_id', Auth::user()->id)
            ->first();

        if (! $chatbox) {
            $chatbox = new ChatBox();
            $chatbox->customer_id = $contact->customer_id;
            $chatbox->employee_user_id = Auth::user()->id;
            $chatbox->save();
        }
        $content = 'Contact: '.$contact->email.'<br>'.
           'shipment_id: '.$contact->shipment_id.'<br>'.
           'Subject: '.$contact->subject.'<br>'.
           'message: '.$contact->message;

        $chatboxMessages = new ChatBoxMessages();
        $chatboxMessages->chatbox_id = $chatbox->id;
        $chatboxMessages->from_id = Auth::user()->id;
        $chatboxMessages->content = $content;
        $chatboxMessages->save();
        $contact->is_handled = 1;
        $contact->save();

        return Redirect(route('complaints.messages'));
    }

    public function viewChat($id)
    {
        if (ChatBox::where('id', $id)
            ->where(function ($query) {
                $query->where('customer_id', Auth::user()->id)
                    ->orWhere('employee_user_id', Auth::user()->id);
            })->exists()) {
            $messages = ChatBoxMessages::where('chatbox_id', $id)
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json($messages);
        } else {
            return response(500);
        }
    }
}
