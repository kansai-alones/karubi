<?php

use Illuminate\Database\Seeder;
use App\User;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DatabaseSeeder::class);

        // create dummy user
        $user = User::make([
            'login_id'  => 'taniko',
            'password'  => 'password',
            'type_id'   => 1,
            'years'     => 3,
        ]);
        $user->token = 'a';
        $user->save();
    }
}
