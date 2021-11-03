<?php

namespace Database\Seeders;

use App\Models\Bookable;
use Illuminate\Database\Seeder;
use App\Models\Review;
class ReviewsTableSeeder extends Seeder
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
            $reviews = Review::factory(random_int(5, 30))->make()->each(function($review) use ($users, $bookable) {
                $review->user_id = $users->random()->id;
                $review->bookable_id = $bookable->id;
                //$review->booking_id = $bookable->bookings()->random()->id;
                $review->save();
            });
            $bookable->reviews()->saveMany($reviews);
            //$booking->reviews()->saveMany($reviews);
        });
    }
}
