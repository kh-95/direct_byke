<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\helper;
use App\Http\Requests\LoginRequest;
use App\Models\Client;
use App\Models\Driver;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


   
    public function __construct()
    {
        $this->middleware('Lang'); 
            $this->model = new User();
        
    }

    public function register(Request $request)
    {
        $rules = [
            'fullname' => 'required',
            'password' => 'required|confirmed|min:8|max:25',
            'phone' => ["required", "numeric","regex:/^(009665|9665|00966|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/"],
            'email' => 'nullable',
            
        ];
        $messages = [
            'fullname.required' => trans('validation.user_name'),
            'phone.required' => trans('validation.phone_number_required'),
            'phone.unique' => trans('validation.phone_number_unique'),
            'phone.digits' => trans('validation.phone_number_digits'),
            'password.required' => trans('validation.password_required'),
            'password.confirmed' => trans('validation.password_confirmed'),
            'password.min' => trans('validation.password_min'),
            'password.max' => trans('validation.password_max'),
        ];
        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails()) {
            $errors = $validation->errors();
            $error_data = [];
            foreach ($errors->all() as $error) {
                array_push($error_data, $error);
            }
            $data = $error_data;
            $response = [
                'status' => false,
                'message' => $data,
            ];
            return response()->json($response, 400);
        }
        try {
            $data = $request->except('password');
            $data['password'] = Hash::make($request->password);
            $userDataExists = User::userData($request)->first();
            if ($userDataExists) {
                return response()->json([
                    'status' => false,
                    'message' => trans('validation.phone_number_unique'),
                ], 200);
            }
            $user = User::create($data);
            $user->user_type = 'client';
            $user->active_code = 1111;
            $user->save();
            $msg = __('active code') . ": " . $user->active_code;
            $sms = new helper();
            $sms->sendSMS($user->phone, $msg);

            if ($user) {
                return response()->json([
                    'status' => true,
                    'active_code' => $user->active_code,
                    'message' => trans('validation.user_create_successfully'),
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => trans('validation.error_try_again'),
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
    public function login(Request $request)
    {
        $rules = [
            'phone' => 'required',
            'password' => 'required',
            
        ];
        
        $messages = [
            'phone.required' => trans('validation.phone_required'),
            'password.required' => trans('validation.password_required'),
        ];
        
        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails()) {
            $errors = $validation->errors();
            $error_data = [];
            foreach ($errors->all() as $error) {
                array_push($error_data, $error);
            }
            $data = $error_data;
            $response = [
                'status' => false,
                'message' => $data,
            ];
            return response()->json($response, 400);
        }
        

        $user = User::userData($request)->first();
        if ($user) {
          

            if ($user->is_active == 0) {
                return response()->json([
                    'status' => false,
                    'message' => trans('validation.user_in_active'),
                    'activation' => false,
                ], 400);
            }


            if (Hash::check($request->password, $user->password)) {
                
                return response()->json([
                    'status' => true,
                    'message' => trans('validation.User_Logged_In_Successfully'),
                    'data' => [
                        'token' => $user->createToken("API TOKEN")->plainTextToken,
                        'activation' => true,
                        'user' => $user,
                    ]
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => trans('validation.wrong_password'),
                ], 400);
            }


        } else {
            return response()->json([
                'status' => false,
                'message' => trans('validation.no_account'),
            ], 400);


        }
    }
    


    public function forgetPassword(Request $request) // send forget code
    {

        $user = User::userData($request)->first();
        if ($user) {

            $forget_code =1111;;
            $user->forget_code = $forget_code;
            $user->save();
            $msg = __('validation.forget_code_msg') . ": " . $forget_code;

            $sms = new helper();
            $sms->sendSMS( $user->phone, $msg);


            $data = array(
                'active_code' => $forget_code,
                'phone_number' => $user->phone,
            );
            return response()->json([
                'status' => true,
                'data' => $data,
                'message' => trans('validation.code_sent_to_your_phone'),
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => trans('validation.phoneNumber_not_register')
            ], 400);
        }
    }


    public function verifyCode(Request $request)
    {
        $rules = [
            'phone' => ["required", "numeric","regex:/^(009665|9665|00966|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/"],
            'forget_code' => 'required',
        ];
        $messages = [
            'phone.required' => trans('validation.phone_required'),
            'forget_code.required' => trans('validation.please_enter_the_code_sent'),
        ];

        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails()) {
            $errors = $validation->errors();
            $error_data = [];
            foreach ($errors->all() as $error) {
                array_push($error_data, $error);
            }
            $data = $error_data;
            $response = [
                'status' => false,
                'message' => $data,
            ];
            return response()->json($response, 400);
        }
        $user = User::userData($request)->first();

        if ($user) {
            $check = false;
            if ($request->check_type == 'activation') {
                $check = ($user->active_code == $request->forget_code);
            }
            if ($request->check_type == 'reset_password') {
                $check = ($user->forget_code == $request->forget_code);
            }
            if (!$check) {
                return response()->json([
                    'status' => false,
                    'message' => trans('validation.wrong_code')
                ], 400);
            }

            if ($request->check_type == 'activation') {
                $user->is_active = 1;
                $user->active_code = null;
                $user->save();
                return response()->json([
                    'status' => true,
                    'message' => trans('validation.done_activation'),
                ], 200);

            }

            if ($request->check_type == 'reset_password') {
                return response()->json([
                    'status' => true,
                    'message' => trans('validation.The_sent_code_has_been_verified'),
                ], 200);

            }

        } else {
            return response()->json([
                'status' => false,
                'message' => trans('validation.no_user')

            ]);
        }
    }


    public function resetPassword(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'phone' => 'required',
            'password' => 'required|confirmed',
        ]);
        if ($validation->fails()) {
            $errors = $validation->errors();
            $error_data = [];
            foreach ($errors->all() as $error) {
                array_push($error_data, $error);
            }
            $data = $error_data;
            $response = [
                'status' => false,
                'message' => $data,
            ];
            return response()->json($response, 400);
        }

        $user = User::userData($request)->first();
        
        if ($user) {
            $password = $request->password;
            $user->password = bcrypt($password);
            $user->forget_code = null;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => trans('validation.password_has_been_modified')
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => trans('validation.please_verify_the_password')
            ], 400);
        }
    }


    public function resendVerification(Request $request) // check_type => [ activation || reset_password ]
    {
        $user = User::where('phone', $request->phone)
           ->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => trans('validation.phoneNumber_not_register')
            ]);
        }

       
        $code = 1111;
        if ($request->check_type == 'activation') {
            $code = 1111;
            $user->active_code = $code;
            $msg = __('activation_code_msg') . ": " . $code;
        }
        if ($request->check_type == 'reset_password') {
            $user->forget_code = $code;
            $msg = __('forget_code_msg') . ": " . $code;
        }
        $user->save();
        $sms = new helper();
      //  $sms->sendSMS($user->phone, $msg);


        $data = array(
            'active_code' => $code,
            'phone_number' => $user->phone,
        );
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => trans('validation.code_sent_to_your_phone'),
        ], 200);
    }



    


    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => true,
            'message' => trans('validation.you_have_been_successfully_logged_out'),
            'logout' => true
        ], 200);
    }


   


   

    // public
    // function changePassword(Request $request)
    // {
    //     $validation = validator()->make($request->all(), [
    //         'current_password' => 'required',
    //         'password' => 'required|confirmed|min:8|max:25',
    //     ]);
    //     if ($validation->fails()) {
    //         $errors = $validation->errors();
    //         $error_data = [];
    //         foreach ($errors->all() as $error) {
    //             array_push($error_data, $error);
    //         }
    //         $data = $error_data;
    //         $response = [
    //             'status' => false,
    //             'message' => $data,
    //         ];
    //         return response()->json($response, 400);
    //     }

    //     $user = auth()->user();
    //     if (!Hash::check($request->current_password, $user->password)) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => trans('validation.the_old_password_is_incorrect'),
    //         ], 400);

    //     }
    //     $request['password'] = bcrypt($request->password);
    //     $request->user()->update($request->all());

    //     return response()->json([
    //         'status' => true,
    //         'message' => trans('validation.password_has_been_updated'),
    //     ], 200);

    // }


}


