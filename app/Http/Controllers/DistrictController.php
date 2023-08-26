<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;
use App\Models\Region;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\District;
use App\Models\City;

class DistrictController extends Controller
{
    public function index (Request $request)
    {
        $query = District::query();
        $regions = Region::all();
        $regions = $regions->pluck('name_en', 'id')->toArray();
        $cities = [];
        if ($request->region_id) {
            $cities = City::where('region_id', $request->region_id)->get();
            $cities = $cities->pluck('name_en', 'id')->toArray();
            if ($request->city_id && !in_array($request->city_id, array_keys($cities))) {
                $request->city_id = null;
            }
        }
        else {
            $request->city_id = null;
        }
        $districts = District::Filter($request, $query)->paginate(10);

        return view('districts.index')->with('districts', $districts)->with('cities', $cities)->with('regions', $regions);
    }

    public function create ()
    {
        $district = new District();
        $regions = Region::where('is_active', 1)->get();;
        return view('districts.create' ,compact('district' ,'regions'));
    }

    public function store (CreateDistrictRequest $request)
    {
        $data = $request->validated();
//        $city = City::find($request->city_id);
//        if (empty($city)) {
//            Flash::error('City not found');
//            return redirect(route('districts.index'));
//        }
//        $region_id = $city->region->id;
        $district = District::create($data);
        Flash::success('District saved successfully.');
        return redirect(route('districts.index'));
    }

    public function show ($id)
    {
        $district = District::find($id);
        if (empty($district)) {
            Flash::error('District not found');
            return redirect(route('districts.index'));
        }
        return view('districts.show')->with('district', $district);
    }

    public function edit ($id)
    {
        $district = District::find($id);
        if (empty($district)) {
            Flash::error('District not found');
            return redirect(route('districts.index'));
        }
        $regions = Region::all();
        return view('districts.edit')->with('district', $district)->with('regions', $regions);
    }

    public function update (UpdateDistrictRequest $request, $id)
    {
        $district = District::find($id);
        if (empty($district)) {
            Flash::error('District not found');
            return redirect(route('districts.index'));
        }
        $data = $request->validated();
//        $city = City::find($request->city_id);
//        if (empty($city)) {
//            Flash::error('City not found');
//            return redirect(route('districts.index'));
//        }
//        $region_id = $city->region->id;
//        $data['region_id'] = $region_id;
        $district->update($data);
        Flash::success('District updated successfully.');
        return redirect(route('districts.index'));
    }

    public function destroy ($id)
    {
        $district = District::find($id);
        if (empty($district)) {
            Flash::error('District not found');
            return redirect(route('districts.index'));
        }
        $district->delete();
        Flash::success('District deleted successfully.');
        return redirect(route('districts.index'));
    }

    public function changeStatusDistrict (Request $request)
    {
        $data = $request->all();
        $district = District::find($request->district_id);
        $district->is_active = $request->status;
        $district->save();
        return response()->json(['success' => 'Status change successfully.']);
    }
}
