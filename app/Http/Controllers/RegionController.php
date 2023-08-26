<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Region;

class RegionController extends Controller
{
    public function index(Request $request)
    {
        $query = Region::query();
        $regions = Region::Filter($request, $query)->paginate(10);
        return view('regions.index')->with('regions', $regions);

    }

    public function create()
    {
        return view('regions.create');
    }

    public function store(CreateRegionRequest $request)
    {
        $data = $request->all();
        $region = Region::create($data);
        Flash::success('Region saved successfully.');
        return redirect(route('regions.index'));
    }

    public function show($id)
    {
        $region = Region::find($id);
        if (empty($region)) {
            Flash::error('Region not found');
            return redirect(route('regions.index'));
        }
        return view('regions.show')->with('region', $region);
    }

    public function edit($id)
    {
        $region = Region::find($id);
        if (empty($region)) {
            Flash::error('Region not found');
            return redirect(route('regions.index'));
        }
        return view('regions.edit')->with('region', $region);
    }

    public function update($id, UpdateRegionRequest $request)
    {
        $region = Region::find($id);
        if (empty($region)) {
            Flash::error('Region not found');
            return redirect(route('regions.index'));
        }
        $data = $request->validated();
        $region->fill($data)->save();
        Flash::success('Region updated successfully.');
        return redirect(route('regions.index'));
    }

    public function destroy($id)
    {
        $region = Region::find($id);
        if (empty($region)) {
            Flash::error('Region not found');
            return redirect(route('regions.index'));
        }
        $region->delete();
        Flash::success('Region deleted successfully.');
        return redirect(route('regions.index'));
    }

    public function changeStatusRegion(Request $request)
    {
        $data = $request->all();
        $region = Region::find($request->region_id);
        $region->is_active = $request->status;
        // get data from query string
        $region->save();
        return response()->json(['success' => 'Status change successfully.']);
    }

}
