<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateGeneralSettingRequest;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    public function edit()
    {
        $general_setting = GeneralSetting::first();
        return view('general_settings.edit')->with('general_settings', $general_setting);
    }

    public function update(UpdateGeneralSettingRequest $request)
    {
        $general_setting = GeneralSetting::first();
        $general_setting->update($request->all());
        return redirect()->route('general_setting.edit')->with('success', 'General Setting Updated Successfully');
    }
}
