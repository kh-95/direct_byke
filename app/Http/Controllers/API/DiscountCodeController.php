<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\DiscountCodeResource;
use App\Models\DiscountCode;
use Illuminate\Http\Request;

class DiscountCodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('Lang');

    }

    public function getDiscountCodes(Request $request)
    {
        $discountCodes = DiscountCode::query()->where('is_active', 1)->paginate(10);
        return response()->json([
            'status' => true,
            'data' => DiscountCodeResource::collection($discountCodes),
            'links' => [
                'first' => $discountCodes->url(1),
                'last' => $discountCodes->url($discountCodes->lastPage()),
                'prev' => $discountCodes->previousPageUrl(),
                'next' => $discountCodes->nextPageUrl(),
            ],
        ]);
    }

    public function getDiscountCode ($id)
    {
        $discountCode = DiscountCode::query()->where('is_active', 1)->find($id);
        if (!$discountCode)
            return response()->json([
                'status' => false,
                'message' => 'discount code not found'
            ]);

        return response()->json([
            'status' => true,
            'data' => new DiscountCodeResource($discountCode)
        ]);

    }

    public function increaseNumberOfUsage($id)
    {
        $discountCode = DiscountCode::query()->where('is_active', 1)->find($id);
        $discountCode->number_usage = $discountCode->number_usage + 1;
        $discountCode->save();
        return response()->json([
            'status' => true,
            'data' => new DiscountCodeResource($discountCode)
        ]);
    }
}
