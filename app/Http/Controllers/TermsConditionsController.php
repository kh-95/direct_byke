<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTermsConditionsRequest;
use App\Http\Requests\UpdateTermsConditionsRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\TermsConditions;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Validator;
use Response;
use App\Helpers\Traits\RepositoryTrait;
use App\Models\TermCondition;

class TermsConditionsController extends AppBaseController
{
    use RepositoryTrait;

    public $model;

    public function __construct(TermCondition $model)
    {
        $this->model = $model;
    }


    public function showTermsCondition()
    {
        $termsConditions = TermCondition::first();
        return view('terms_conditions.edit', compact('termsConditions'));
    }


    public function updateTermsCondition(Request $request)
    {

        $validator = $request->validate([
            'content_ar' => 'required',
            'content_en' => 'required',
        ]);
        $data = [
            'content_ar' => $request->content_ar,
            'content_en' => $request->content_en,
        ];


        $showTermsCondition = TermCondition::first();
        if (empty($showTermsCondition)) {
            TermCondition::create($data);
            Flash::success(__('messages.saved', ['model' => __('models/terms_conditions.singular')]));
            return back();
        }


        $showTermsCondition->fill($data);
        $showTermsCondition->save();

        Flash::success(__('messages.updated', ['model' => __('models/terms_conditions.singular')]));
        return back();
    }

}
