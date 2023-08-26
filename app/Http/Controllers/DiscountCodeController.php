<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDiscountCodeRequest;
use Illuminate\Http\Request;
use App\Models\DiscountCode;
use Laracasts\Flash\Flash;

class DiscountCodeController extends Controller
{
    public function index(Request $request)
    {
        $query = DiscountCode::query();
        $discountCodes = DiscountCode::Filter($request, $query)->paginate(10);
        return view('discount_codes.index')->with('discount_codes', $discountCodes);

    }

    public function create()
    {
        return view('discount_codes.create');
    }

    public function store(CreateDiscountCodeRequest $request)
    {
        $data = $request->all();
        $data['number_usage'] = 0;
        $data['is_active'] = 1;
        $discountCode = DiscountCode::create($data);
        Flash::success('Region saved successfully.');
        return redirect(route('discount_codes.index'));
    }

    public function show($id)
    {
        $discountCode = DiscountCode::find($id);
        if (empty($discountCode)) {
            Flash::error('Region not found');
            return redirect(route('discount_codes.index'));
        }
        return view('discount_codes.show')->with('discount_code', $discountCode);
    }

    public function edit($id)
    {
        $discountCode = DiscountCode::find($id);
        if (empty($discountCode)) {
            Flash::error('Region not found');
            return redirect(route('discount_codes.index'));
        }
        return view('discount_codes.edit')->with('discount_code', $discountCode);
    }

    public function update($id, CreateDiscountCodeRequest $request)
    {
        $discountCode = DiscountCode::find($id);
        if (empty($discountCode)) {
            Flash::error('Region not found');
            return redirect(route('discount_codes.index'));
        }
        $data = $request->all();
        $discountCode->update($data);
        Flash::success('Region updated successfully.');
        return redirect(route('discount_codes.index'));
    }

    public function destroy($id)
    {
        $discountCode = DiscountCode::find($id);
        if (empty($discountCode)) {
            Flash::error('Region not found');
            return redirect(route('discount_codes.index'));
        }
        $discountCode->delete();
        Flash::success('Region deleted successfully.');
        return redirect(route('discount_codes.index'));
    }

    public function changeStatusDiscountCode(Request $request)
    {
        $discountCode = DiscountCode::find($request->discount_code_id);
        if (empty($discountCode)) {
            Flash::error('Region not found');
            return redirect(route('discount_codes.index'));
        }
        $discountCode->is_active = $request->status;
        $discountCode->save();
        Flash::success('Region status changed successfully.');
        return response()->json(['success' => 'Status change successfully.']);
    }
}
