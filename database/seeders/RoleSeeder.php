<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Users;
use Faker\Factory as Faker;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // Tạo dữ liệu giả cho 5 vai trò
        $roles = [
            [
                'name' => "Manager",
                "desc" => "manager booking when user book in their company"
            ],
            [
                'name' => "User",
                "desc" => "Users in web they can booking room"
            ],
        ];

        $role = Role::all();
        if ($role) :
            foreach ($role as $r) {
                $users = Users::where('role_id', $r->id)->get();
                foreach ($users as $user) {
                    $user->delete();
                }
                $r->delete();
            }
            foreach ($roles as $key => $value) {
                Role::create([
                    'name' => $value["name"],
                    'desc' => $value["desc"],
                ]);
            }
        else :
            foreach ($roles as $key => $value) {
                Role::create([
                    'name' => $value["name"],
                    'desc' => $value["desc"],
                ]);
            }
        endif;
    }
}
