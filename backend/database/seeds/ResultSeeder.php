<?php

use Illuminate\Database\Seeder;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10000; $i++) {
            $user = \App\User::make([
                'login_id'  => str_random(32),
                'password'  => 'password',
                'type_id'   => rand(1, 2),
                'years'     => rand(1, 3),
            ]);
            $user->token = str_random(40);
            $user->save();
            \DB::table('results')->insert([
                'user_id'   => $user->id,
                'score'     => rand(0, 100),
                'level'     => rand(1, 5)
            ]);
        }
    }
}
