<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCityRequest;
use App\Http\Requests\UpdateCityRequest;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\City;
use App\Models\Region;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $query = City::query();
        $cities = City::Filter($request, $query)->paginate(10);
        $regions = Region::all();
        $regions = $regions->pluck('name_en', 'id')->toArray();

        return view('cities.index')->with('cities', $cities)->with('regions', $regions);
    }

    public function create()
    {
        $city = new City();
        $regions = Region::where('is_active', 1)->get();;
        return view('cities.create', compact('city'))->with('regions', $regions);
    }

    public function store(CreateCityRequest $request)
    {
        $data = $request->validated();
        $city = City::create($data);
        Flash::success('City saved successfully.');
        return redirect(route('cities.index'));
    }

    public function show($id)
    {
        $city = City::find($id);
        if (empty($city)) {
            Flash::error('City not found');
            return redirect(route('cities.index'));
        }
        return view('cities.show')->with('city', $city);
    }

    public function edit($id)
    {
        $city = City::find($id);
        if (empty($city)) {
            Flash::error('City not found');
            return redirect(route('cities.index'));
        }
        $regions = Region::all();
        return view('cities.edit')->with('city', $city)->with('regions', $regions);
    }

    public function update($id, UpdateCityRequest $request)
    {
        $city = City::find($id);
        if (empty($city)) {
            Flash::error('City not found');
            return redirect(route('cities.index'));
        }
        $data = $request->all();
        $city->fill($data)->save();
        Flash::success('City updated successfully.');
        return redirect(route('cities.index'));
    }

    public function destroy($id)
    {
        $city = City::find($id);
        if (empty($city)) {
            Flash::error('City not found');
            return redirect(route('cities.index'));
        }
        $city->delete();
        Flash::success('City deleted successfully.');
        return redirect(route('cities.index'));
    }

    public function changeStatusCity(Request $request)
    {
        $data = $request->all();
        $city = City::find($request->city_id);
        $city->is_active = $request->status;
        $city->save();
        return response()->json(['success' => 'Status change successfully.']);
    }

    public function getCityList(Request $request)
    {
        $cities = City::where("region_id", $request->region_id)->get();
        return $cities;
    }

}
