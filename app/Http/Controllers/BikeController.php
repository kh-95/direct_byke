<?php

namespace App\Http\Controllers;

use App\Helpers\Traits\images;
use App\Http\Requests\CreateBikeRequest;
use App\Http\Requests\CreateBikeTypeRequest;
use App\Http\Requests\UpdateBikeRequest;
use App\Models\BikeDuration;
use App\Models\GeneralSetting;
use App\Models\TripDuration;
use Illuminate\Http\Request;
use App\Models\Bike;
use App\Models\BikeType;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class BikeController extends Controller
{
    public function index(Request $request)
    {
        $query = Bike::query();
        $bikes = Bike::Filter($request, $query)->paginate(10);
        $bike_types = BikeType::all();
        $bike_types = $bike_types->pluck('name_en', 'id')->toArray();

        return view('bikes.index')->with('bikes', $bikes)->with('bike_types', $bike_types);
    }

    public function create()
    {
        $bike = new Bike();
        $bike_types = BikeType::where('is_active', 1)->get();
        return view('bikes.create', compact('bike'))->with('bike_types', $bike_types);
    }


    public function store(CreateBikeRequest $request)
    {
        $data = $request->validated();
        $bike = Bike::create($data);
        $durations = Arr::pull($data, 'durations');

        foreach ($durations as $duration) {
            $bike->durations()->create(["duration" => $duration]);
        }

        if ($bike) {
            $QR_name = $request->name_en . '_' . time() . '.svg';
            $QR_path = 'storage/QR/' . $QR_name;
            $QR = QrCode::generate($bike->id, $QR_path);
            $bike->QR_code = $QR_name;
            $bike->save();
        }
        $file = new images();
        $destinationPath = "storage/bikes/";
        $file->images($request, $destinationPath, $bike);
        Flash::success('Bike Type saved successfully.');
        return redirect(route('bikes.index'));
    }

    public function show($id)
    {
        $bike = Bike::find($id);
        if (empty($bike)) {
            Flash::error('Bike Type not found');
            return redirect(route('bikes.index'));
        }
        return view('bikes.show')->with('bike', $bike);
    }

    public function edit($id)
    {
        $bike = Bike::find($id);
        if (empty($bike)) {
            Flash::error('Bike Type not found');
            return redirect(route('bikes.index'));
        }
        $bike_types = BikeType::all();
        return view('bikes.edit')->with('bike', $bike)->with('bike_types', $bike_types);
    }

    public function update($id, UpdateBikeRequest $request)
    {
        $data = $request->all();
        $bike = Bike::find($id);
        $bike->update($data);
        // check if have image and QR images
        if ($request->hasFile('image_data')) {
            // delete old image
            $bike = Bike::find($id);
            if ($bike->image) {
                $image = $bike->image->file;
                $image = substr($image, 8);
                unlink(storage_path($image));
                $bike->image->delete();
            }
            $file = new images();
            $destinationPath = "storage/bikes/";
            $file->images($request, $destinationPath, $bike);
        }
        Flash::success('Bike Type updated successfully.');
        return redirect(route('bikes.index'));
    }

    public function destroy($id)
    {
        $bike = Bike::find($id);
        if (empty($bike)) {
            return redirect(route('bikes.index'));
        }
        if ($bike->image) {
            $image = $bike->image->file;
            $image = substr($image, 8);
            unlink(storage_path($image));
            $bike->image->delete();
        }
        if ($bike->QR_code) {
            $QR = $bike->QR_code;
            unlink(storage_path('QR/' . $QR));
        }
        $bike->delete();
        Flash::success('Bike Type deleted successfully.');
        return redirect(route('bikes.index'));
    }

    public function changeStatusBike(Request $request)
    {
        $bike = Bike::find($request->bike_id);
        if (empty($bike)) {
            return redirect(route('bikes.index'));
        }
        $bike->is_active = $bike->status;
        $bike->save();
        Flash::success('Bike Type status changed successfully.');
        return response()->json(['success' => 'Status change successfully.']);
    }

    public function QRToPdf($id)
    {
        $bike = Bike::find($id);
        if (empty($bike)) {
            Flash::error('Bike Type not found');
            return redirect(route('bikes.index'));
        }
        $pdf = PDF::loadView('bikes.QR', compact('bike'));
        return $pdf->download('QR.pdf');

    }

    public function addDuration(Request $request)
    {
        $bike = Bike::find($request->bike_id);
        if (empty($bike)) {
            return redirect(route('bikes.index'));
        }
        $pricePerMinute = GeneralSetting::first()->price_per_minute;
        $price = $pricePerMinute * $request->duration;
        $data = [
            'bike_id' => $request->bike_id,
            'duration' => $request->duration,
            'price' => $price,
        ];
        $duration = TripDuration::create($data);
        Flash::success('Trip duration Created successfully.');
        return redirect(route('bikes.show', $bike->id));
    }

    public function removeDuration($id)
    {
        $duration = TripDuration::find($id);
        if (empty($duration)) {
            return redirect(route('bikes.index'));
        }
        $duration->delete();
        Flash::success('Trip duration deleted successfully.');
        return redirect(route('bikes.show', $duration->bike_id));
    }
}
