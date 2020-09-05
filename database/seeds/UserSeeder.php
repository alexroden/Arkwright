<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $data = [
            [
                'token'      => '9202587b-ef37-41ed-a24f-4620067dbeac',
                'first_name' => 'Test',
                'last_name'  => 'User',
                'email'      => 'test@test.com',
            ],
        ];

        foreach ($data as $user) {
            /** @var \App\User $user */
            $user = User::create($user);
        }
    }
}
