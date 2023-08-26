<?php

namespace Database\Seeders;

use App\Models\ReservationPrice;
use App\Models\TransferFee;
use Illuminate\Database\Seeder;

class ReservationPricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // \DB::table('reservation_prices')->truncate();
        $reservation_prices = [
            ['price_from' => 0 ,'price_to' => 100 ],
            ['price_from' => 101 ,'price_to' => 200 ],
            ['price_from' => 201 ,'price_to' => 300 ],
            ['price_from' => 301 ,'price_to' => 400 ],
            ['price_from' => 401 ,'price_to' => 1000000 ],
        ];
        foreach ($reservation_prices as $reservation_price) {
            ReservationPrice::create($reservation_price);
        }

    }
}
