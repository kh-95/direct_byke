<?php

namespace App\Http\Controllers\API;

use App\Helpers\helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function getProfile()
    {
        $user = auth()->user();
        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'user not found'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => new ProfileResource($user)
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'user not found'
            ]);
        }
        $rules = [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'full_address' => 'required|string|max:255',
        ];
        $messages = [
            'fullname.required' => 'fullname is required',
            'fullname.string' => 'fullname must be string',
            'fullname.max' => 'fullname must be less than 255 char',
            'email.required' => 'email is required',
            'email.email' => 'email must be email',
            'email.unique' => 'email must be unique',
            'full_address.required' => 'full_address is required',
            'full_address.string' => 'full_address must be string',
            'full_address.max' => 'full_address must be less than 255 char',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->full_address = $request->full_address;
        $user->birthday = $request->birthday;
        $user->save();

        return response()->json([
            'status' => true,
            'data' => new ProfileResource($user)
        ]);
    }

    public function changePhone(Request $request)
    {
        $user = auth()->user();
        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'user not found'
            ]);
        }
        $rules = [
            'new_phone' => ["required", "numeric","unique:users,phone","regex:/^(009665|9665|00966|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/"],
        ];
        $messages = [
            'new_phone.required' => 'phone is required',
            'new_phone.numeric' => 'phone must be numeric',
            'new_phone.unique' => 'phone must be unique',
            'new_phone.regex' => 'phone must be valid',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        $otp_code = 1111;
        $msg = __('forget_code_msg') . ": " . $otp_code;
        $sms = new helper();
        $sms->sendSMS($request->new_phone, $msg);
        $user->is_send_otp = 1;
        $user->new_phone = $request->new_phone;
        $user->save();

        $user->otps()->create([
            'code' => $otp_code,
            'type' => 'change_phone',
            'target' => $request->new_phone,
            'user_type' => 'App\Models\User',
            'user_id' => $user->id,
            'type' => 'phone',
            'expires_at' => now()->addHours(5),
        ]);

        $data = [
            'otp_code' => $otp_code,
            'new_phone' => $request->new_phone,
        ];


        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function verifyCode(Request $request)
    {
        $user = auth()->user();
        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'user not found'
            ]);
        }
        $rules = [
            'code' => 'required|numeric',
            'new_phone' => ["required", "numeric","unique:users,phone","regex:/^(009665|9665|00966|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/"],
        ];
        $messages = [
            'code.required' => 'code is required',
            'code.numeric' => 'code must be numeric',
            'new_phone.required' => 'phone is required',
            'new_phone.numeric' => 'phone must be numeric',
            'new_phone.unique' => 'phone must be unique',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        $otp = $user->otps()->valid($user->new_phone, 'phone')->first();
        if(!$otp){
            return response()->json([
                'status' => false,
                'message' => 'code is invalid'
            ]);
        }
        if($otp->code != $request->code){
            return response()->json([
                'status' => false,
                'message' => 'code is invalid'
            ]);
        }
        $user->phone = $user->new_phone;
        $user->new_phone = null;
        $user->is_send_otp = 0;
        $user->save();
        $otp->delete();

        return response()->json([
            'status' => true,
            'message' => 'phone changed successfully'
        ]);
    }

    public function changePassword(Request $request)
    {
        $user = auth()->user();
        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'user not found'
            ]);
        }
        $rules = [
            'old_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8|same:new_password',
        ];
        $messages = [
            'old_password.required' => 'old_password is required',
            'old_password.string' => 'old_password must be string',
            'old_password.min' => 'old_password must be more than 8 char',
            'new_password.required' => 'new_password is required',
            'new_password.string' => 'new_password must be string',
            'new_password.min' => 'new_password must be more than 8 char',
            'new_password.confirmed' => 'new_password must be confirmed',
            'confirm_password.required' => 'confirm_password is required',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        if(!password_verify($request->old_password, $user->password)){
            return response()->json([
                'status' => false,
                'message' => 'old_password is invalid'
            ]);
        }
        $user->password = bcrypt($request->new_password);
        $user->save();


        $user->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'password changed successfully'
        ]);
    }
}
