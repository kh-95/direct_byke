<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OfferResource;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    public function __construct()
    {
        $this->middleware('Lang');

    }
    public function getOffers(Request $request)
    {
        $offers = Offer::query()->where('is_active', 1)->paginate(1);
        return response()->json([
            'status' => true,
            'data' => OfferResource::collection($offers),
            'links' => [
                'first' => $offers->url(1),
                'last' => $offers->url($offers->lastPage()),
                'prev' => $offers->previousPageUrl(),
                'next' => $offers->nextPageUrl(),
            ],
        ]);
    }

    public function getOffer($id)
    {
        $offer = Offer::query()->where('is_active', 1)->find($id);
        if (!$offer) {
            return response()->json([
                'status' => false,
                'message' => trans('validation.there_are_no_data')
            ], 400);
        }
        return response()->json([
            'status' => true,
            'data' => new OfferResource($offer)
        ]);
    }
}
