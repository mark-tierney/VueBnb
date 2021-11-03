<?php

namespace Database\Seeders;

use App\Models\Bookable;
use App\Models\Booking;
use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Bookable::all()->each(function (Bookable $bookable){
            $users = \App\Models\User::all();
            $bookings = \App\Models\Booking::factory(random_int(1,20))->make()->each(function($booking) use ($users, $bookable) {
                $booking->user_id = $users->random()->id;
                $booking->bookable_id = $bookable->id;
                //$review->booking_id = $bookable->bookings()->random()->id;
                $booking->save();
            });
            //$bookings = collect([$booking]);



            // for($i = 0; $i < random_int(1,20); $i++){
            //     $from = (clone $booking->to)->addDays(random_int(1, 14));
            //     $to = (clone $from)->addDays(random_int(1, 14));

            //     $booking = Booking::make([
            //         'from' => $from,
            //         'to' => $to,
            //         'price' => random_int(200,5000),
            //         'user_id' => $users->random()->id
            //     ]);
            //     $bookings->push($booking);
            // }

            $bookable->bookings()->saveMany($bookings);
        });
    }
}
