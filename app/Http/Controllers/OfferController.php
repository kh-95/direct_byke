<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOfferRequest;
use App\Models\BikeType;
use App\Models\Offer;
use App\Models\Bike;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $query = Offer::query();
        $offers = Offer::filter($request)->paginate(10);
        $bikes = Bike::where('is_active', 1);
        $bikes = $bikes->pluck('name_en', 'id')->toArray();
        return view('offers.index', compact('offers'))->with('bikes', $bikes);
    }

    public function create()
    {
        $bike_types = BikeType::where('is_active', 1)->get();
        return view('offers.create')->with('bike_types', $bike_types);
    }

    public function store(CreateOfferRequest $request)
    {
        $data = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'percentage' => $request->percentage,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'is_active' => 1,
        ];
        $offer = Offer::create($data);
        $bikes = $request->bike_id;
        foreach ($bikes as $bike) {
            $bike = Bike::find($bike);
            if ($bike->offer_id == null) {
                $bike->offer_id = $offer->id;
                $bike->save();
            }
        }
        Flash::success('Offer saved successfully.');
        return redirect(route('offers.index'));
    }

    public function show($id)
    {
        $offer = Offer::find($id);
        $bike_types = BikeType::where('is_active', 1)->get();
        return view('offers.show')->with('offer', $offer)->with('bike_types', $bike_types);
    }

    public function edit($id)
    {
        $offer = Offer::find($id);
        $bikes = Bike::all();
        return view('offers.edit')->with('offer', $offer)->with('bikes', $bikes);
    }

    public function update($id, CreateOfferRequest $request)
    {
        $offer = Offer::find($id);
        $data   = $request->all();
        $offer->update($data);
        Flash::success('Offer updated successfully.');
        return redirect(route('offers.index'));
    }

    public function destroy($id)
    {
        $offer = Offer::find($id);
        $offer->delete();
        Flash::success('Offer deleted successfully.');
        return redirect(route('offers.index'));
    }

    public function changeStatusOffer(Request $request)
    {
        $offer = Offer::find($request->offer_id);
        $offer->is_active = $request->status;
        $offer->save();
        Flash::success('Offer status changed successfully.');
        return response()->json(['success' => 'Status change successfully.']);
    }

    public function removeBikeFromOffer(Request $request)
    {
        $request->validate([
            'bike_id' => 'required',
            'offer_id' => 'required',
        ]);
        $bike = Bike::find($request->bike_id);
        $bike->offer_id = null;
        $bike->save();
        Flash::success('Bike removed successfully.');
        return redirect(route('offers.show', $request->offer_id));
    }

    public function addBikeToOffer(Request $request)
    {
        $request->validate([
            'bike_id' => 'required',
            'offer_id' => 'required',
        ]);
        $bike = Bike::find($request->bike_id)->first();
        if ($bike->offer_id != null) {
            Flash::error('Bike already added to another offer.');
            return redirect(route('offers.show', $request->offer_id));
        }
        $bike->offer_id = $request->offer_id;
        $bike->save();
        Flash::success('Bike added successfully.');
        return redirect(route('offers.show', $request->offer_id));
    }


}
