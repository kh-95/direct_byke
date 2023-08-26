<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageReplyRequest;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Contact;
use App\Models\ContactReply;
use Illuminate\Support\Facades\Mail;

class ContactReplyController extends Controller
{
    public function store (CreateMessageReplyRequest $request)
    {
        $user = auth()->user();

        $contact = Contact::find($request->contact_id);
        $data = [
            'reply' => $request->reply,
            'contact_id' => $request->contact_id,
            'added_by_id' => $user->id,
        ];

        try {
            Mail::to($contact->email)->send(new \App\Mail\messageReply($contact, $request->reply));
        } catch (\Exception $e) {
            Flash::error('Reply Saved successfully but email not sent.');
            //return redirect(route('contacts.index'));
        }
        ContactReply::create($data);
        $contact->message_status = 'replied';
        $contact->save();
        Flash::success('Reply sent successfully.');
        return redirect(route('contacts.index'));
    }
}
