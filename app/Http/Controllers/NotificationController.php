<?php

namespace App\Http\Controllers;

use App\Helpers\Traits\RepositoryTrait;
use App\Jobs\SendNotification;
use App\Models\Client;
use App\Models\Driver;
use App\Models\SendNotification as ModelsSendNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Response;


class NotificationController extends AppBaseController
{
    use RepositoryTrait;

    public function index(Request $request)
    {

        $notifications = DB::table('send_notification')
            ->where( function ($q)use ($request) {
                $q->where('title_ar', 'like', "%$request->keyword%");
                $q->orWhere('sender_type',$request->sender_type);
            })
            ->latest('created_at');
        $notifications = $notifications->paginate(10);

        // dd($notifications);
        return view('notifications.index')
            ->with('notifications', $notifications);

    }

    public function show($id)
    {
        $notification = ModelsSendNotification::find($id);
       
        return view('notifications.show')->with('notification', $notification);
    }




    public function getNotificationSended(Request $request)
    {
        $notifications = \App\Models\SendNotification::latest('created_at');
        $notifications = $notifications->paginate(10);
        return view('notifications.get_send_notification', compact('notifications'));

    }

    public function getFormNotification(Request $request)
    {
        return view('notifications.send_notification');

    }

    public function sendNotification(Request $request)
    {
       
        $rules = [
            'title_ar' => 'required',
            'title_en' => 'required',
            'content_ar' => 'required',
            'content_en' => 'required',
            'sender' => 'required',
        ];

       
            if ($request->sender == 'client') {
                $rules['clients'] = 'required';
            }
    
      

        $this->validate($request, $rules);

        $input = $request->all();

        $chunk_number = 200;
        if (in_array($request->sender, ['clients','client'])) {
            $clients = User::where('is_active', 1)->whereIn('id', $request->clients);
            
       
            $clients=$clients->chunk($chunk_number, function ($chunkedUsers) use ($request) {
                $message_ar = $request->title_ar . "\n" . $request->content_ar;
                $message_en = $request->title_en . "\n" . $request->content_en;
                $msg = 'message_ar';
                $message = isset($msg) ? $$msg : $message_ar;
                $data = [
                    'type' => 'management message',
                ];
                dispatch(new SendNotification($chunkedUsers, $message, $message_en, $data, $request->sender));
            });
        
      

//dd($request->drivers);
//        $drivers_count =  + $drivers_en->count();
//        $client_count = $clients_ar->count() + $clients_en->count();
//
//
//        dd($drivers_count , $client_count);

       
        
           

            // $clients_en = $clients_en->chunk($chunk_number, function ($chunkedUsers) use ($request) {
            //     $message_ar = $request->title_ar . "\n" . $request->content_ar;
            //     $message_en = $request->title_en . "\n" . $request->content_en;
            //     $msg = 'message_en';
            //     $message = isset($msg) ? $$msg : $message_ar;
            //     $data = [
            //         'type' => 'management message',
            //     ];
            //     dispatch(new SendNotification($chunkedUsers, $message, $message_en, $data, $request->sender));
            // });
        }


      

        \App\Models\SendNotification::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'content_ar' => $request->content_ar,
            'content_en' => $request->content_en,
            'sender_type' => $request->sender,
        ]);

        Flash::success(__('messages.saved', ['model' => __('models/notifications.singular')]));

        return redirect(route('notification.get-notification-sended'));
    }

}
