<?php

use App\Enums\General\SettingDataTypes;
use App\Models\Setting;
use App\Models\TemporaryUpload;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

if (!function_exists('uploadImage')) {
    function uploadImage(Model|Authenticatable $model, string $file, string $assignedCollectionName): void
    {
        $collectionName = explode('|', $file)[1];
        $collectionId = explode('|', $file)[0];
        $temporaryUpload = TemporaryUpload::where('id', $collectionId)->where('name', $collectionName)->first();
        if ($temporaryUpload) {
            $model->clearMediaCollection($assignedCollectionName);
            $temporaryUpload ?->media() ?->update(
                [
                    'model_type' => get_class($model),
                    'model_id' => $model->id,
                    'collection_name' => $assignedCollectionName,
                ]
            );
            $temporaryUpload->delete();
        }
    }
}

if (!function_exists('setSetting')) {
    function setSettings(string $key, mixed $value): void
    {
        cache()->forget($key);
        Setting::updateOrCreate(
            [
                'key' => $key
            ],
            [
                'value' => $value,
            ]
        );
        cache()->put($key, $value, now()->addDay());
    }
}
if (!function_exists('getSetting')) {
    function getSetting(string $key, mixed $default = null): mixed
    {
        if (cache()->has($key)) {
            return cache()->get($key);
        }
        $setting = Setting::where('key', $key)->first();
        if ($setting) {
            cache()->put($key, $setting->value, now()->addDay());
            return $setting->value;
        }
        return $default;
    }
}
if (!function_exists('status')) {
    function status($type, $key)
    {
        return optional(\App\Models\Status::where('type', $type)->where('key', $key)->first())->id ?? null;
    }
}

if (!function_exists('getDistance')) {
    function getDistance($lat1, $lon1, $lat2, $lon2, $unit = 'K')
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }
}
if (!function_exists('checkLocationInRange')) {
    function checkLocationInRange($region, $lat, $long)
    {
        $distance=getDistance($region->lat,$region->long,$lat,$long);
        if($distance<=$region->radius){
            return $region;
        }else{
            return null;
        }
    }
}

if (!function_exists('getDeliveryPrice')) {
    function getDeliveryPrice($lat1,$long1, $lat2, $long2)
    {
        $distance=getDistance($lat1,$long1,$lat2,$long2)??1;
        $price=getSetting('delivery_price',10);
        return (float)round($distance*$price,2);
    }
}
function nearDrivers($order)
{
    $store_lat=$order->store_id?$order->store->latitude:$order->store_lat;
    $store_long=$order->store_id?$order->store->longitude:$order->store_long;
    $deliveries = \App\Models\Driver::select(\Illuminate\Support\Facades\DB::raw('*, ( 6371 * acos( cos( radians(' .
        $store_lat . ') ) * cos( radians( lat ) ) * cos(radians( long ) - radians(' .
        $store_long . ') ) + sin( radians(' . $store_lat .
        ') ) * sin( radians( lat ) ) ) ) as distance'))
        ->where('status', 1)->where('is_active',1)
        ->with('device_tokens')
        ->whereDoesntHave('orders', function ($q) {
            $q->whereHas('status', function ($q) {
                $q->whereIn('key', ['new', 'accepted','wait_accept_offer','paid','preparing','prepared', 'ready_for_delivery', 'delivering'])->whereType('order');
            });
        })
        ->having('distance', '<=', 50)
        ->orderBy('distance')->get();
    return $deliveries;
}
function send_fcm_notification($user, $notification_data, $is_admin = false, $tokens = [],$array=null)
{
    $firebaseTokens = [];
    if ($is_admin) {
            $firebaseTokens = \App\Models\DeviceToken::where('tokenable_type', 'App\Models\User')
                ->whereHas('tokenable',function ($q){
                    $q->whereHas('roles');
                })->pluck('device_token')->all();
    } else {
        if ($user && $array==null) {
            $firebaseTokens = $user->deviceTokens->pluck('device_token')->all();
        }elseif($user && $array){
            $firebaseTokens = $user;
        } else {
            $firebaseTokens = \App\Models\DeviceToken::where('tokenable_type', 'App\Models\User')
                ->whereHas('tokenable',function ($q){
                    $q->whereDoesntHave('roles');
                })->pluck('device_token')->all();
        }
    }
//    dd($firebaseTokens);
    $notif_arr = [];
    $data_arr = [];
    $notif_arr['content'] = array(
        'model_id' => $notification_data['model_id'] ?? null,
        'channelKey' => 'basic_channel',
        'sound' => 'default',
        'timestamp' => date('Y-m-d G:i:s'),
        'data' => $notification_data[app()->getLocale()],
        'title' => $notification_data[app()->getLocale()]['title'],
        'body' => $notification_data[app()->getLocale()]['body'],
        'type' => $notification_data['type'] ?? null,
        'pay' => $notification_data['pay'] ?? null,
        'status' => $notification_data['status'] ?? null,
    );
    $notif_arr['notification'] = array(
        'model_id' => $notification_data['model_id'] ?? null,
        'channelKey' => 'basic_channel',
        'sound' => 'default',
        'timestamp' => date('Y-m-d G:i:s'),
        'data' => $notification_data[app()->getLocale()],
        'title' => $notification_data[app()->getLocale()]['title'],
        'body' => $notification_data[app()->getLocale()]['body'],
        'type' => $notification_data['type'] ?? null,
        'pay' => $notification_data['pay'] ?? null,
        'status' => $notification_data['status'] ?? null,
    );

    $data_arr['content'] = array(
        'model_id' => $notification_data['model_id'] ?? null,
        'channelKey' => 'basic_channel',
        'sound' => 'default',
        'timestamp' => date('Y-m-d G:i:s'),
        'data' => $notification_data[app()->getLocale()],
        'title' => $notification_data[app()->getLocale()]['title'],
        'body' => $notification_data[app()->getLocale()]['body'],
        'type' => $notification_data['type'] ?? null,
        'pay' => $notification_data['pay'] ?? null,
        'status' => $notification_data['status'] ?? null,
    );
    $data_arr['notification'] = array(
        'model_id' => $notification_data['model_id'] ?? null,
        'channelKey' => 'basic_channel',
        'sound' => 'default',
        'timestamp' => date('Y-m-d G:i:s'),
        'data' => $notification_data[app()->getLocale()],
        'title' => $notification_data[app()->getLocale()]['title'],
        'body' => $notification_data[app()->getLocale()]['body'],
        'type' => $notification_data['type'] ?? null,
        'pay' => $notification_data['pay'] ?? null,
        'status' => $notification_data['status'] ?? null,
    );
    // $data = [
    //     "registration_ids" => $firebaseTokens,
    //     "notification" => array_merge(\Illuminate\Support\Arr::only($notification_data, ['title', 'body']), ['channelKey' => 'basic_channel']),
    //     "data" => \Illuminate\Support\Arr::only($notification_data, ['model_id', 'type'])
    // ];
    $data = [
        "registration_ids" => $firebaseTokens,
//        "mutable_content" => true,
//        "content_available" => true,
//        "priority" => "high",
        "data" => $notification_data,
        //"data" => array('content' => $data_arr),
        "notification" => $notification_data
    ];
    $dataString = json_encode($data);
    //dd(config('app.FCM_KEY'));
    $headers = [
        'Authorization: key=' . config('app.fcm_server_key'),
        'Content-Type: application/json',
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    $response = curl_exec($ch);
//    dd($response);
    curl_close($ch);
    if ($response === false) {
        // throw new Exception('Curl error: ' . curl_error($crl));
        //print_r('Curl error: ' . curl_error($crl));
        $result = 0;
    } else {
        $result = 1;
    }
    return $result;
}

