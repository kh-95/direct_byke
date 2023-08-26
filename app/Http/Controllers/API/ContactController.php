<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(CreateContactRequest $request)
    {
        $rules = [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
            'content' => 'required|string|max:255',
            'message_types' => 'required|in:ORDER,SUGGESTION,INQUIRY,COMPLAIN,OTHER'
        ];
        $messages = [
            'fullname.required' => 'fullname is required',
            'fullname.string' => 'fullname must be string',
            'fullname.max' => 'fullname must be less than 255 characters',
            'email.required' => 'email is required',
            'email.email' => 'email must be email',
            'email.max' => 'email must be less than 255 characters',
            'phone.required' => 'phone is required',
            'phone.numeric' => 'phone must be numeric',
            'content.required' => 'content is required',
            'content.string' => 'content must be string',
            'content.max' => 'content must be less than 255 characters',
            'message_types.required' => 'message_type is required',
            'message_types.in' => 'message_type must be one of ORDER,SUGGESTION,INQUIRY,COMPLAIN,OTHER',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 400);
        }

        $data = $request->validated();


        $contact = Contact::query()->create($data);
        return response()->json([
            'status' => true,
            'data' => $contact
        ]);
    }
}
