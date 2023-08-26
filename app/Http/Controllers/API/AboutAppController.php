<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\StaticPagesResource;
use App\Models\AboutAPP;

class AboutAppController extends Controller
{
    public function __construct()
    {
        $this->middleware('Lang');

    }
    public function index()
    {
        $about_app = AboutApp::first();
        $about_app->title_ar = 'عن التطبيق';
        $about_app->title_en = 'About App';
        return response()->json(['status' => true, 'data' => new StaticPagesResource($about_app)]);
    }
}
