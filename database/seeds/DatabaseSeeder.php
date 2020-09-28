<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 10)->create()
            ->each(function($user){

            $user->link()->saveMany(factory(\App\Link::class, 10)->make(['user_id' => $user->id]))
                ->each(function($link){

                    $link->statistic()->saveMany(factory(\App\Statistic::class, 10)->make(['link_id' => $link->id]));

                });
        });
    }
}
