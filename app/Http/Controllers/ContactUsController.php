<?php

namespace App\Http\Controllers;

use App\Helpers\Traits\RepositoryTrait ;
use App\Http\Requests\CreateContactUsRequest;
use App\Http\Requests\UpdateContactUsRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Contactus;
use Illuminate\Http\Request;
use Flash;
use Response;

class ContactUsController extends AppBaseController
{
    use RepositoryTrait;

    public function showContactus()
    {
        $contactUs = Contactus::first();
        return view('contactuses.edit', compact('contactUs'));
    }


    public function updateContactus(Request $request)
    {
        $validator = $request->validate([
            'facebook_link' => 'required',
            'insta_link' => 'required',
            'snap_link' => 'required',
            'whatsapp' => 'required',
            'new_phone' => 'required',
        ]);

        $data = [
            'facebook_link' => $request->facebook_link,
            'insta_link' => $request->insta_link,
            'snap_link' => $request->snap_link,
            'whatsapp' => $request->whatsapp,
            'new_phone' => $request->new_phone,
        ];

        $contactUs = Contactus::first();
        if (empty($contactUs)) {
            Contactus::create($data);
            Flash::success(__('messages.saved', ['model' => __('models/contactuses.singular')]));
            return back();
        }


        $contactUs->fill($data);
        $contactUs->save();

        Flash::success(__('messages.updated', ['model' => __('models/contactuses.singular')]));

        return back();
    }
}
