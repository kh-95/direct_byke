<?php

namespace App\Http\Resources\Api;


use Illuminate\Http\Request;


use App\Http\Helpers\HijriDateClass;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        // $msg_in_locale = 'message_' . app()->getLocale();
        // if(app()->getLocale() == 'ar'){
        //     $msg_in_locale = 'message';
        // }

     //   $msg = $this->data[$msg_in_locale] ?? $this->data["message_en"];

        return [
            'id' => $this->id,
          //  'message' => nl2br($msg),
            'read' => (boolean)$this->read_at,
            'date_meladi' => $this->created_at->toDateString(),
            'time' => Carbon::parse($this->created_at)->format('h:i A'),
            'type' => $this->type,
           
        ];
    }
}
