<?php

namespace Database\Seeders;

use App\Models\Realtor;
use App\Models\User;
use Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RealtorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('realtors')->delete();
        DB::table('users')->delete();

        User::Factory(20)->create();
        $faker = Faker\Factory::create();

        $users = DB::table('users')->get();
        foreach ($users as $user) {
            DB::table('realtors')->insert([
                'phone' => $faker->phoneNumber(),
                'user_id' => $user->id,
            ]);
        }
    }
}
