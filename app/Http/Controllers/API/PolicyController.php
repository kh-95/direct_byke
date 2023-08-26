<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\StaticPagesResource;
use App\Models\Policy;

class PolicyController extends Controller
{
    public function __construct()
    {
        $this->middleware('Lang');

    }
    public function index()
    {
        $policy = Policy::first();
        $policy->title_ar = 'سياسة الخصوصية';
        $policy->title_en = 'Privacy Policy';
        return response()->json(['status' => true, 'data' => new StaticPagesResource($policy)]);
    }
}
