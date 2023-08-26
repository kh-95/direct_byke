<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\SendMassage;
use App\Models\User;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Traits\RepositoryTrait;

class ClientController extends Controller
{

    public $model;

    // public function __construct()
    // {
    //     $this->middleware(['can:users index'])->only('index');
    //     $this->middleware(['can:users show'])->only('show');

    // }

    public function index(Request $request)
    {
        $clients = User::latest();
        if ($request->keyword) {
            $clients = $clients->where(function ($q) use ($request) {
                $q->where('fullname', 'like', '%' . $request->keyword . '%');
                $q->orWhere('phone', 'like', '%' . $request->keyword . '%');
                $q->orWhere('email', 'like', '%' . $request->keyword . '%');
                $q->orWhere('is_active', 'like', '%' . $request->keyword . '%');
                
            });
        }
        $clients = $clients->paginate(10);
        return view('clients.index')
            ->with('clients', $clients);
    }


    public function show($id)
    {
        $client = User::find($id);
        if (empty($client)) {
            Flash::error(__('models/clients.singular') . ' ' . __('messages.not_found'));

            return redirect(route('clients.index'));
        }
        return view('clients.show')->with('client', $client);
    }

    public function changeStatusUser(Request $request)
    {
        $user = User::find($request->user_id);
        $user->is_active = $request->status;
        $user->save();
        if ($request->status == 1) {
            return response()->json(['success' => 'Status change successfully to active.']);
        } else {
            return response()->json(['success' => 'Status change successfully to in active .']);
        }
    }


 

}
