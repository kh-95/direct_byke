<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\HomeResource;
use Illuminate\Http\Request;
use App\Models\BikeType;
use App\Models\Bike;
use Illuminate\Contracts\Support\Responsable;
use  App\Helpers\MessageResponse;
use App\Http\Resources\Api\BikeTypeResource;
use App\Http\Resources\Api\CityResource;
use App\Contracts\FilterShowDataContract;
use App\Http\Requests\Client\Home\FiterRequest;
use App\Http\Requests\Client\Home\PriceRequest;
use App\Http\Resources\Api\BikeDurationResource;
use App\Http\Resources\Api\BikeResource;
use App\Http\Resources\Api\DistrictResource;
use App\Http\Resources\Api\FilterBikeResource;
use App\Http\Resources\Api\NotificationResource;
use App\Http\Resources\Api\OrderResource;
use App\Http\Resources\Api\PriceResource;
use App\Http\Resources\Api\RegionResource;
use App\Models\City;
use App\Models\District;
use App\Models\Region;
use App\Models\ReservationPrice;
use App\Models\TripDuration;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    /**
     */

    public function __construct()
    {
        $this->lang = request()->header('lang') ?? 'ar';
//        $this->middleware('Lang');
    }


//    public function index(Request $request)
//    {
//        if ($request->status_code == 500) {
//            return response()->json(['data' => null, 'message' => '', 'status' => 'fail'], 500);
//        }
//        return HomeResource::make(auth()->user())->additional(['status' => true, 'message' => '']);
//    }


//    public function get_bikeTypes(Request $request, FilterShowDataContract $filterShowDataContract): Responsable
//    {
//        $bikeTypes = BikeType::query()
//            ->with(['bikes'])->orderBy('id', 'desc');
//        $pipelines = [
//            \App\Filters\Status::class,
//        ];
//        $bikessDataAndPagination = $filterShowDataContract->handle($bikeTypes, $pipelines, $request->per_page);
//        return new MessageResponse(
//            body: [
//                'bikeTypes' => BikeTypeResource::collection($bikessDataAndPagination['items']),
//                'links' => $bikessDataAndPagination['links'],
//                'meta' => $bikessDataAndPagination['meta'],
//            ]
//        );
//    }
//
//    public function getregions(Request $request)
//    {
//        $regions = Region::where('is_active', 1)->get();
//        return response()->json([
//            'status' => true,
//            'data' => $regions
//        ]);
//    }
//
//    public function citiesOfRegions(Request $request)
//    {
//        $regions = Region::whereHas('cities', function ($q) {
//            $q->where('is_active', 1)
//                ->wherehas('districts', function ($q) {
//                    $q->where('is_active', 1);
//                });
//        })->where('is_active', 1)->get();
//        if (sizeof($regions) > 0) {
//            return response()->json([
//                'status' => true,
//                'data' => RegionResource::collection($regions)
//            ]);
//        }
//        return response()->json([
//            'status' => false,
//            'message' => trans('validation.there_are_no_data')
//        ], 400);
//    }
//
//
//    public function getCities()
//    {
//        $cities = City::where('is_active', 1)->get();
//        return response()->json([
//            'status' => true,
//            'data' => CityResource::collection($cities)
//        ]);
//    }
//
//
//    public function getDistricts()
//    {
//        $districts = District::where('is_active', 1)->get();
//        return response()->json([
//            'status' => true,
//            'data' => DistrictResource::collection($districts)
//        ]);
//    }
//
//    public function districtsOfCities(Request $request)
//    {
//        $citiess = City::whereHas('districts')->where('is_active', 1)->get();
//        if (sizeof($citiess) > 0) {
//            return response()->json([
//                'status' => true,
//                'data' => CityResource::collection($citiess)
//            ]);
//        }
//        return response()->json([
//            'status' => false,
//            'message' => trans('validation.there_are_no_data')
//        ], 400);
//    }
//
//
//    public function priceBikes(Request $request)
//    {
//
//        $rules = [
//            'price_from' => 'required|numeric',
//            'price_to' => 'required|numeric'
//        ];
//
//        $messages = [
//            'price_from.required' => trans('validation.price_from_required'),
//            'price_to.required' => trans('validation.price_to_required'),
//            'price_from.digits' => trans('validation.price_from_digits'),
//            'price_to.digits' => trans('validation.price_to_digits'),
//        ];
//
//
//        $validation = Validator::make($request->all(), $rules, $messages);
//        if ($validation->fails()) {
//            $errors = $validation->errors();
//            $error_data = [];
//            foreach ($errors->all() as $error) {
//                array_push($error_data, $error);
//            }
//            $data = $error_data;
//            $response = [
//                'status' => false,
//                'message' => $data,
//            ];
//            return response()->json($response, 400);
//        }
//        $prices = ReservationPrice::where(function ($q) use ($request) {
//            $q->where('price_from', '>=', (int)$request->price_from)
//                ->where('price_to', '<=', (int)$request->price_to);
//        })->get();
//
//        //  dd($prices);
//        return response()->json([
//            'status' => true,
//            'data' => PriceResource::collection($prices)
//        ]);
//    }

    public function filterBike(Request $request)
    {
        $bikes = Bike::query();


//        $bikesCoordinates = $this->getBikeInRedius($bikes, $request);
//
//        if (isset($request->bike_type_id) && filled($request->bike_type_id)) {
//            $bikesCoordinates = $bikes->where('bike_type_id', $request->bike_type_id);
//        }

//        if ($request->price_from && $request->price_to) {
            $bikesCoordinates = $bikes->DurationPrice($request);
//
//            $price_id = ReservationPrice::where(function ($q) use ($request) {
//                $q->where('price_from', '>=', (int)$request->price_from)
//                    ->where('price_to', '<=', (int)$request->price_to);
//            })->pluck('id');
//        }
//
        $bikes = $bikesCoordinates->get();
        return response()->json([
            'status' => true,
            'data' => FilterBikeResource::collection($bikes)
        ]);


    }


    public function getBikeInRedius($bikes, $request)
    {
        $unit = 6378.10;
        $unit = 3959;  // for Miles
        $redius = 100;
        if (isset($request->region_id)) {
            if ($request->region_id) {
                $model = Region::find($request->region_id);
            }

            if ($request->region_id && $request->city_id) {
                $model = City::find($request->city_id);
            }
            if ($request->region_id && $request->city_id & $request->district_id) {
                $model = City::find($request->city_id);
            }

            $lat = $model->lat;
            $lon = $model->lon;
        } else {
            $lat = $request->lat;
            $lon = $request->lon;

        }
        $bikes = $bikes->select('bikes.*'
            , \DB::raw("truncate( ($unit * ACOS(COS(RADIANS($lat))
                   * COS(RADIANS(bikes.lat))
                   * COS(RADIANS($lon) - RADIANS(bikes.lon))
                   + SIN(RADIANS($lat))
                   * SIN(RADIANS(bikes.lat)))) , 2) as distance"
            ))
            ->having('distance', '<=', $redius)
            ->orderBy('distance');


//        $bikes = $bikes->select('bikes.*'
//            , \DB::raw("truncate( ($unit * ACOS(COS(RADIANS($lat))
//                   * COS(RADIANS(bikes.lat))
//                   * COS(RADIANS($lon) - RADIANS(bikes.lon))
//                   + SIN(RADIANS($lat))
//                   * SIN(RADIANS(bikes.lat)))) , 2) as distance"
//            ));

//        $bikes = $bikes->select(\Illuminate\Support\Facades\DB::raw('*, ( 6371 * acos( cos( radians(' . $request->lat . ') )
//         * cos( radians( `lat` ) ) * cos(radians( `lon` ) - radians(' . $request->lon . ') ) + sin( radians(' . $request->lat . ') )
//         * sin( radians( `lat` ) ) ) ) as distance'))
//           ;


        return $bikes;
//        return [
//            'lat' => $lat,
//            'lon' => $lon,
//        ];


    }

    public function startTrip(Request $request)
    {

        $bike = $request->bike_id;

        $Bikes = TripDuration::where('bike_id', $bike)->get();

        return response()->json([
            'status' => true,
            'data' => BikeResource::collection($Bikes)
        ]);
    }

    public function submitTrip(Request $request)
    {
        $rules = [
            'discount_code' => 'nullable|exists:discount_codes,discount_code',
        ];

        $messages = [
            'discount_code.exists' => trans('validation.discount_code_exists'),

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

        $bike = $request->bike_id;


        $Bikes = TripDuration::where('bike_id', $bike)->get();


        return response()->json([
            'status' => true,
            'data' => OrderResource::collection($Bikes)
        ]);
    }


    public function getNotification(Request $request)
    {
        $user = auth()->user();
        $rows = $user->notifications->where('read_at', null);
        $rows = $rows->each(function ($row) use ($request) {
            if ($row->read_at == null) {
                $read = false;
            } else {
                $read = true;
            }


            // $msg_in_locale = 'message_' . $this->lang;

            // if ($this->lang == 'ar') {
            //     $msg_in_locale = 'message';
            // }
            //    $msg = $row->data[$msg_in_locale] ?? $row->data["message_en"];
            //     $row->message = $msg;
            $row->read = $read;
            $row->date = $row->created_at->toDateString();
            $row->time = Carbon::parse($row->created_at)->format('h:i A');
            //    $row->type = $row->data['type'];
            //   $row->api_link = $row->data['link'];
            //  $row->name = $row->data['name'];
        });
        $rows = $this->paginate($rows, 10);
        if (sizeOf($rows) > 0) {
            return NotificationResource::collection($rows)->additional([
                "status" => true
            ]);
        }
        return response()->json(
            [
                'status' => false,
                'message' => trans('validation.there_are_no_data')
            ], 400);
    }

    public function paginate($rows, $perPage)
    {
        $pageStart = request('page', 1);
        $offSet = ($pageStart * $perPage) - $perPage;
        $itemsForCurrentPage = $rows->slice($offSet, $perPage);

        return new LengthAwarePaginator(
            $itemsForCurrentPage, $rows->count(), $perPage,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );
    }


    public function notificationRead(Request $request)
    {

        if ($request->filled('notification_id')) {
            $notification = auth()->user()->unreadNotifications()
                ->where('id', $request->notification_id)->first();

            if ($notification) {
                $notification->markAsRead();
                return response()->json([
                    'status' => true,
                    'message' => trans('validation.The_notification_has_been_read_successfully')
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => trans('validation.An_error_occurred_while_reading_the_notification')
                ], 400);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => trans('validation.The_entered_code_is_invalid')
            ], 400);
        }
    }
}
