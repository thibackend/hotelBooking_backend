<?php

namespace Database\Seeders;

use App\Models\accounts;
use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AccountSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Lấy danh sách users
        $users = Users::pluck('id')->all();
        // Tạo dữ liệu giả cho 50 tài khoản
        foreach ($users as $key => $value) {
            $user = Users::find($value);
            accounts::create([
                'user_id' => $user->id,
                'user_name' => $user->user_name,
                'email' =>$user->email,
                'password' =>$user->password// Bạn có thể sửa đổi giá trị mật khẩu tại đây
            ]);
        }
        // for ($i = 0; $i < 50; $i++) {
        //     accounts::create([
        //         'user_id' => $faker->randomElement($users),
        //         'user_name' => $faker->userName(),
        //         'email' => $faker->unique()->safeEmail(),
        //         'password' => bcrypt('password'), // Bạn có thể sửa đổi giá trị mật khẩu tại đây
        //     ]);
        // }
    }
}