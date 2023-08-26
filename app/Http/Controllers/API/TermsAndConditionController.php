<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\StaticPagesResource;
use App\Models\TermCondition;

class TermsAndConditionController extends Controller
{
    public function __construct()
    {
        $this->middleware('Lang');

    }
    public function index()
    {
        $terms_and_condition = TermCondition::first();
        $terms_and_condition->title_ar = 'الشروط والأحكام';
        $terms_and_condition->title_en = 'Terms and Conditions';
        return response()->json(['status' => true, 'data' => new StaticPagesResource($terms_and_condition)]);
    }
}
