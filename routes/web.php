<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth::routes();

Auth::routes([
    // 'register' => false, // Registration Routes...
    'logout' => false,
]);


Route::get('change-lang/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'ar'])) {
        session()->put('lang', $lang);
    } else {
        session()->put('lang', 'ar');
    }
    return redirect()->back();
})->name('lang');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');;

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
 Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::group([
    'middleware' =>
        [
            'auth:web',
            'autoCheckPermission',
            'Lang'

        ]], function () {


// login routes




 Route::post('update-profile', [App\Http\Controllers\AuthController::class,'updateProfile'])->name('updateProfile');
 // clients

Route::resource('clients', App\Http\Controllers\ClientController::class);
Route::get('changeStatusUser', [App\Http\Controllers\ClientController::class, 'changeStatusUser']);

// admins

Route::resource('users', App\Http\Controllers\UserController::class);
Route::get('changeStatusAdmin', [App\Http\Controllers\UserController::class, 'changeStatusAdmin']);


// roles

Route::resource('roles', App\Http\Controllers\RoleController::class);

Route::get('changeStatusRole', [App\Http\Controllers\RoleController::class, 'changeStatusRole']);

// Regions

Route::resource('regions', App\Http\Controllers\RegionController::class);
Route::get('changeStatusRegion', [App\Http\Controllers\RegionController::class, 'changeStatusRegion'])->name('regions.changeStatus');


// Cities

Route::resource('cities', App\Http\Controllers\CityController::class);
Route::get('changeStatusCity', [App\Http\Controllers\CityController::class, 'changeStatusCity'])->name('cities.changeStatus');

// Districts

Route::resource('districts', App\Http\Controllers\DistrictController::class);
Route::get('changeStatusDistrict', [App\Http\Controllers\DistrictController::class, 'changeStatusDistrict'])->name('districts.changeStatus');

// Bike Types

Route::resource('bike_types', App\Http\Controllers\BikeTypeController::class);
Route::get('changeStatusBikeType', [App\Http\Controllers\BikeTypeController::class, 'changeStatusBikeType'])->name('bike_types.changeStatus');

// Bikes

Route::resource('bikes', App\Http\Controllers\BikeController::class);
Route::get('changeStatusBike', [App\Http\Controllers\BikeController::class, 'changeStatusBike'])->name('bikes.changeStatus');
Route::get('QRToPdf/{id}', [App\Http\Controllers\BikeController::class, 'QRToPdf'])->name('bikes.QRToPdf');
Route::post('bike_duration', [App\Http\Controllers\BikeController::class, 'addDuration'])->name('bikes.newDuration');
Route::delete('bike_duration/{id}', [App\Http\Controllers\BikeController::class, 'removeDuration'])->name('bikes.removeDuration');

// contacts

Route::resource('contacts', App\Http\Controllers\ContactController::class);
// contact replies

Route::resource('contact_replies', App\Http\Controllers\ContactReplyController::class);

// Discount Codes

Route::resource('discount_codes', App\Http\Controllers\DiscountCodeController::class);
Route::get('changeStatusDiscountCode', [App\Http\Controllers\DiscountCodeController::class, 'changeStatusDiscountCode'])->name('discount_codes.changeStatus');

// Offers

Route::resource('offers', App\Http\Controllers\OfferController::class);
Route::get('changeStatusOffer', [App\Http\Controllers\OfferController::class, 'changeStatusOffer'])->name('offers.changeStatus');
Route::post('remove_bike', [App\Http\Controllers\OfferController::class, 'removeBikeFromOffer'])->name('offers.removeBike');
Route::post('add_bike', [App\Http\Controllers\OfferController::class, 'addBikeToOffer'])->name('offers.addBike');

// General Settings

Route::get('general_setting', [App\Http\Controllers\GeneralSettingController::class, 'edit'])->name('general_setting.edit');
Route::post('general_setting', [App\Http\Controllers\GeneralSettingController::class, 'update'])->name('general_setting.update');

// contactus


Route::get('contactus', [App\Http\Controllers\ContactUsController::class, 'showContactus'])->name('show_contactus');
Route::post('update-contactus', [App\Http\Controllers\ContactUsController::class, 'updateContactus'])->name('edit_contactus');

// about app

Route::get('get-about-app', [App\Http\Controllers\AboutAppController::class, 'showAboutApp'])->name('show_about_app');
Route::post('update-about-app', [App\Http\Controllers\AboutAppController::class, 'updateAboutApp'])->name('edit_about_app');

// terms and conditions

Route::resource('termsConditions', App\Http\Controllers\TermsConditionsController::class);


Route::get('get-terms-conditions', [App\Http\Controllers\TermsConditionsController::class, 'showTermsCondition'])->name('show_Terms_condition');
Route::post('update-terms-conditions', [App\Http\Controllers\TermsConditionsController::class, 'updateTermsCondition'])->name('edit_terms_conditions');


// policies

Route::get('get-policies', [App\Http\Controllers\PolicyController::class, 'showPolicy'])->name('show_policies');
Route::post('update-policies', [App\Http\Controllers\PolicyController::class, 'updatePolicy'])->name('edit_policies');

// notifications

Route::resource('notifications', App\Http\Controllers\NotificationController::class);

Route::post('send-notification', [App\Http\Controllers\NotificationController::class, 'sendNotification'])
->name('notification.sendNotification');

Route::get('get-send-notification', [App\Http\Controllers\NotificationController::class, 'getNotificationSended'])
->name('notification.get-notification-sended');

Route::get('form-notification', [App\Http\Controllers\NotificationController::class, 'getFormNotification'])
->name('notification.form-notification');



    Route::get('get-city-list', [App\Http\Controllers\CityController::class, 'getCityList'])->name('cities.getCityList');


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

    Route::match(['get', 'post'], 'logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');

});


Route::get('/', function () {
    return redirect()->route('login');
});
Route::any('/{any}', function () {
    return view('welcome');
})->where('any', '.*');












