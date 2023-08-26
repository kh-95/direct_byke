<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'prefix' => 'v1',

], function () {

    Route::group([
        'prefix' => 'client',

    ], function () {

        Route::get('filter-bikes', [App\Http\Controllers\API\HomeController::class, 'filterBike']);


        Route::post('register', [App\Http\Controllers\API\AuthController::class, 'register']);
        Route::post('login', [App\Http\Controllers\API\AuthController::class, 'login']);
        Route::post('forget-password', [App\Http\Controllers\API\AuthController::class, 'forgetPassword']);
        Route::post('verify-code', [App\Http\Controllers\API\AuthController::class, 'verifyCode']);
        Route::post('reset-password', [App\Http\Controllers\API\AuthController::class, 'resetPassword']);
        Route::post('resend-verification', [App\Http\Controllers\API\AuthController::class, 'resendVerification']);
        // contact_us
        Route::post('contact-us', [App\Http\Controllers\API\ContactController::class, 'store']);
        // about_app
        Route::get('about-us', [App\Http\Controllers\API\AboutAppController::class, 'index']);

        // Terms and condition
        Route::get('terms-and-condition', [App\Http\Controllers\API\TermsAndConditionController::class, 'index']);

        // Policy
        Route::get('policy', [App\Http\Controllers\API\PolicyController::class, 'index']);

        // active _bikes

        Route::get('get-bikes', [App\Http\Controllers\API\HomeController::class, 'get_bikeTypes']);

        // active _regions
        Route::get('get-regions', [App\Http\Controllers\API\HomeController::class, 'getregions']);

        // active_cities
        Route::get('get-cities', [App\Http\Controllers\API\HomeController::class, 'getCities']);


        Route::get('cities-of-regions', [App\Http\Controllers\API\HomeController::class, 'citiesOfRegions']);


        // districts

        Route::get('get-districts', [App\Http\Controllers\API\HomeController::class, 'getDistricts']);

        Route::get('districts-of-cities', [App\Http\Controllers\API\HomeController::class, 'districtsOfCities']);
        // reservation_prices
        Route::post('price-bikes', [App\Http\Controllers\API\HomeController::class, 'priceBikes']);

        //



        //  Route::post('send-massage', [App\Http\Controllers\API\MainController::class, 'sendMassage']);

        Route::group(['middleware' => ['auth:sanctum']], function () {
            //   Route::post('delete-account', [App\Http\Controllers\API\AuthController::class, 'deleteAccount']);
            Route::get('logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
            //   Route::get('profile-data', [App\Http\Controllers\API\AuthController::class, 'profileData']);
            //Route::post('change-password', [App\Http\Controllers\API\AuthController::class, 'changePassword']);
            // Route::post('update-profile', [App\Http\Controllers\API\AuthController::class, 'updateProfile']);

            Route::get('home', [App\Http\Controllers\API\HomeController::class, 'index'])->name('home');


            // notifications
            Route::get('get-notification', [App\Http\Controllers\API\HomeController::class, 'getNotification']);
            Route::get('notification-read', [App\Http\Controllers\API\HomeController::class, 'notificationRead']);


            // offers
            Route::get('get-offers', [App\Http\Controllers\API\OfferController::class, 'getOffers']);
            Route::get('get-offer/{id}', [App\Http\Controllers\API\OfferController::class, 'getOffer']);

            // discount_codes
            Route::get('get-discount-codes', [App\Http\Controllers\API\DiscountCodeController::class, 'getDiscountCodes']);
            Route::get('get-discount-code/{id}', [App\Http\Controllers\API\DiscountCodeController::class, 'getDiscountCode']);


            // profile
            Route::get('profile', [App\Http\Controllers\API\ProfileController::class, 'getProfile']);

            // update profile
            Route::post('update-profile', [App\Http\Controllers\API\ProfileController::class, 'updateProfile']);

            // change phone
            Route::post('change-phone', [App\Http\Controllers\API\ProfileController::class, 'changePhone']);

            // verify phone
            Route::post('verify-phone', [App\Http\Controllers\API\ProfileController::class, 'verifyCode']);

            // change password
            Route::post('change-password', [App\Http\Controllers\API\ProfileController::class, 'changePassword']);

            // start_trip
            Route::get('get-scan-code', [App\Http\Controllers\API\HomeController::class, 'startTrip']);

            Route::post('submit-trip', [App\Http\Controllers\API\HomeController::class, 'submitTrip']);

            // client_trip

            Route::post('get-trips', [App\Http\Controllers\API\TripController::class, 'getTrips']);

            // trip-details

            Route::get('trips', [App\Http\Controllers\API\TripController::class, 'show']);

            Route::post('rate-trip', [App\Http\Controllers\API\TripController::class, 'rateTrip']);

            Route::post('end-trip', [App\Http\Controllers\API\TripController::class, 'endTrip']);

            Route::post('renew-trip', [App\Http\Controllers\API\TripController::class, 'RenewTrip']);

            Route::post('invoice', [App\Http\Controllers\API\TripController::class, 'getInvoice']);

        });

    });

});

