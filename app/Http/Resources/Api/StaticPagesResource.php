<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StaticPagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $currentLang = $request->header('lang');
        $lang = $currentLang ?? config('app.default_locale');
        return [
            'title' => $this->{'title_' . $lang},
            'content' => $this->{'content_' . $lang},
        ];
    }
}
