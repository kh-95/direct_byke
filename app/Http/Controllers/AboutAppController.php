<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Models\TermsConditions;
use App\Models\WhoUs;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Helpers\Traits\RepositoryTrait;
use App\Models\AboutAPP;

class AboutAppController extends AppBaseController
{
    use RepositoryTrait;

    public $model;

    public function __construct(AboutAPP $model)
    {
        $this->model = $model;
    }

    public function showAboutApp()
    {
        $aboutApp = AboutAPP::first();
        return view('aboutapp.edit', compact('aboutApp'));
    }


    public function updateAboutApp(Request $request)
    {
        $validator = $request->validate([
            'content_ar' => 'required',
            'content_en' => 'required',
        ]);

        $data = [
            'content_ar' => $request->content_ar,
            'content_en' => $request->content_en,
        ];

        $showAboutApp = AboutAPP::first();
        if (empty($showAboutApp)) {
            AboutAPP::create($data);
            Flash::success(__('تم تعديل من نحن بنجاح'));
            return back();
        }

        $showAboutApp->fill($data);
        $showAboutApp->save();
        Flash::success(__('تم تعديل من نحن بنجاح'));
        return back();
    }

}
