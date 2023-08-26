<?php

namespace App\Jobs;

use App\FirebaseNotification;
use App\Notifications\SkilzatNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $chunk;
    public $message;
    public $message_en;
    public $data;
    public $request;

    public function __construct($chunk, $message, $message_en, $data ,$request)
    {
        $this->chunk = $chunk; //
        $this->message = $message;
        $this->message_en = $message_en;
        $this->data = $data;
        $this->request = $request;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {

        if ($this->request  == 'clients') {
            $send_type = 'client';
        }
      

        // in foreach  || to all
        Notification::send($this->chunk,
            new SkilzatNotification($this->message, $this->message_en, $this->data,
                'notification-read', null, null));
        // $usersTokens = $this->chunk->pluck('player_id')->toArray();
        // $notify = new \App\Models\FirebaseNotification();
        // $notify->sendNote($usersTokens, $this->message, $this->data, 'driver');


    }
}
