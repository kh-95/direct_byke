<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\InvoiceResource;
use App\Http\Resources\Api\OfferResource;
use App\Http\Resources\Api\TripDetailsResource;
use App\Http\Resources\Api\TripDurationResource;
use App\Http\Resources\Api\TripResource;
use App\Models\Offer;
use App\Models\Trip;
use App\Models\TripDuration;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TripController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('Lang');

    }
    public function getTrips(Request $request)
    {
        

        $rules = [
            'status' => 'required|exists:trips,status',           
        ];


        $trips = Trip::where('status',$request->status)->get();
      
        return response()->json([
            'status' => true,
            'data' => TripResource::collection($trips),
            
        ]);
    }


    public function show(Request $request)
    {
        $trip = Trip::where('id',$request->trip_id)->get();
        return response()->json([
            'status' => true,
            'data' => TripDetailsResource::collection($trip),
            
        ]);
    }

  public function rateTrip(Request $request){

    $rules =[

      'rate' =>'required',
      'comment'=>'required|string|max:255',
      'trip_id'=>'required|exists:trips,id'
    ];
    // insert rate & comment in trips

    $messages = [
        'rate.required' => trans('validation.rate_required'),
        'comment.required' =>trans('validation.comment_required'),
        'comment.string' => trans('validation.comment_string'),
        'comment.max' => 'comment must be less than 255 char',
    ];
    $validator = Validator::make($request->all(), $rules, $messages);
    if($validator->fails()){
        return response()->json([
            'status' => false,
            'message' => $validator->errors()->first()
        ]);
    }


    $trip=Trip::where(function ($q) use ($request){
          $q->where('status','finished')
              ->where('id',$request->trip_id);
    })->first();

   
    $trip->user_id =auth()->user()->id;
    $trip->rate = $request->rate;
    $trip->comment = $request->comment;
   
    $trip->update();

    return response()->json([
        'status' => true,
        'message' => trans('validation.rate_is_saved_Successfully'),
    ] ,200);

   

  }

public function endTrip(Request $request){

    $rules =[

        
        'trip_id'=>'required|exists:trips,id'
      ];
       
      $trip=Trip::where(function ($q) use ($request){
        $q->where('status','current')
            ->where('id',$request['trip_id']);
  })->first();

  $trip->status='finished';
  $trip->update();

  return response()->json([
    'status' => true,
    'message' => trans('validation.trip_ended_Successfully'),
] ,200);

}



public function RenewTrip(Request $request)
{
    $bike_id = Trip::where('id',$request->trip_id)->pluck('bike_id');
    

    $tripDurations = TripDuration::where('bike_id', $bike_id)->get();

    return response()->json([
        'status' => true,
        'data' => TripDurationResource::collection( $tripDurations),
        
    ]);
}
 public function getInvoice(Request $request)
 {
    $trip = Trip::where('id',$request->trip_id)->get();
 //dd($trip);
    return response()->json([
        'status' => true,
        'data' => InvoiceResource::collection( $trip),
        
    ],200);


 }
    
}
