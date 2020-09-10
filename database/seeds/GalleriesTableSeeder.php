<?php

use Illuminate\Database\Seeder;

class GalleriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all();

        $users->each(function ($user) {
        	$user->galleries()->save(
        		factory(App\Gallery::class)->make()
        	);
        });
    }
}
