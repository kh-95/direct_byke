<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTermsConditionsRequest;
use App\Http\Requests\UpdateTermsConditionsRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\TermsConditions;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Helpers\Traits\RepositoryTrait;
use App\Models\Policy;
use App\Models\TermCondition;

class PolicyController extends AppBaseController
{
    use RepositoryTrait;

    public $model;

    public function __construct(Policy $model)
    {
        $this->model = $model;
    }


    public function showPolicy()
    {
        $policiy = Policy::first();
        return view('policies.edit', compact('policiy'));
    }


    public function updatePolicy(Request $request)
    {
        $validator = $request->validate([
            'content_ar' => 'required',
            'content_en' => 'required',
        ]);

        $data = [
            'content_ar' => $request->content_ar,
            'content_en' => $request->content_en,
        ];

        $showPolicies = Policy::first();
        if (empty($showPolicies)) {
            Policy::create($data);
            Flash::success(__('messages.saved', ['model' => __('models/terms_conditions.singular')]));
            return back();
        }


        $showPolicies->fill($data);
        $showPolicies->save();

        Flash::success(__('messages.updated', ['model' => __('models/terms_conditions.singular')]));

        return back();
    }

}
