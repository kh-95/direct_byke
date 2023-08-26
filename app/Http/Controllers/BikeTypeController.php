<?php

namespace App\Http\Controllers;

use App\Helpers\Traits\images;
use App\Http\Requests\CreateBikeTypeRequest;
use App\Http\Requests\UpdateBikeTypeRequest;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\BikeType;

class BikeTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = BikeType::query();
        $bike_types = BikeType::Filter($request, $query)->paginate(10);
        return view('bike_types.index', compact('bike_types'));
    }

    public function create()
    {
        $bike_type = new BikeType();
        return view('bike_types.create', compact('bike_type'));
    }

    public function store(CreateBikeTypeRequest $request)
    {
        $validated = $request->validated();
        $data = collect($validated)->except(['image_data'])->toArray();
        $bike_type = BikeType::create($data);

        if ($bike_type) {
            $file = new images();
            $destinationPath = "storage/bikeTypes/";
            $file->images($request, $destinationPath, $bike_type);
        }

        Flash::success('Bike Type saved successfully.');
        return redirect(route('bike_types.index'));
    }

    public function show($id)
    {
        $bike_type = BikeType::find($id);
        if (empty($bike_type)) {
            Flash::error('Bike Type not found');
            return redirect(route('bike_types.index'));
        }
        return view('bike_types.show')->with('bike_type', $bike_type);
    }

    public function edit($id)
    {
        $bike_type = BikeType::find($id);
        if (empty($bike_type)) {
            Flash::error('Bike Type not found');
            return redirect(route('bike_types.index'));
        }
        return view('bike_types.edit')->with('bike_type', $bike_type);
    }

    public function update( UpdateBikeTypeRequest $request ,$id)
    {
        $validated = $request->validated();
        $data = collect($validated)->except(['image_data'])->toArray();
        $bike_type = BikeType::find($id);
        if (empty($bike_type)) {
            Flash::error('Bike Type not found');
            return redirect(route('bike_types.index'));
        }
        $bike_type->update($data);

        $file = new images();
        $destinationPath = "storage/bikeTypes/";
        $file->images($request, $destinationPath, $bike_type);

        Flash::success('Bike Type updated successfully.');
        return redirect(route('bike_types.index'));
    }

    public function destroy($id)
    {
        $bike_type = BikeType::find($id);
        if (empty($bike_type)) {
            Flash::error('Bike Type not found');
            return redirect(route('bike_types.index'));
        }
        if ($bike_type->image) {
            $image = $bike_type->image->file;
            $image = substr($image, 8);
            unlink(storage_path($image));
            $bike_type->image->delete();
        }
        $bike_type->delete();
        Flash::success('Bike Type deleted successfully.');
        return redirect(route('bike_types.index'));
    }

    public function changeStatusBikeType(Request $request)
    {
        $bike_type = BikeType::find($request->bike_type_id);
        if (empty($bike_type)) {
            Flash::error('Bike Type not found');
            return redirect(route('bike_types.index'));
        }
        $bike_type->is_active = $request->status;
        $bike_type->save();
        Flash::success('Bike Type status changed successfully.');
        return response()->json(['success' => 'Status change successfully.']);
    }
}
