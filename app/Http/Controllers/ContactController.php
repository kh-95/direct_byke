<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();
        $contacts = $query->filter($request,$query)->paginate(10);
        return view('contacts.index')->with('contacts', $contacts);
    }


    public function show($id)
    {
        $contact = Contact::find($id);
        if (empty($contact)) {
            Flash::error('Contact not found');
            return redirect(route('contacts.index'));
        }
        if ($contact->read_at == null) {
            $contact->read_at = now();
            $contact->save();
        }
        return view('contacts.show')->with('contact', $contact);
    }
}
