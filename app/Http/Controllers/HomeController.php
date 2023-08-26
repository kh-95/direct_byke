<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth')->except('/');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');

    }

    public function home()
    {

//dd($new_orders_without_driver);
     
        $clients_count = User::where('is_active', 1)->count();
        $users_count = Admin::count();


        return view('home', compact(
             'clients_count', 'users_count'
           
        ));
    }

    public function changeLanguage(Request $request)
    {
        $lang = 'ar';
        if ($request->lang) {
            $lang = $request->lang;
        }
        App::setLocale($lang);
        session()->put('locale', $lang);
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
