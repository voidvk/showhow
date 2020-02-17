<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'автор не известен',
                'email' => 'author_unk@g.g',
                'password' => bcrypt(Str::random(16)),
            ],
            [
                'name' => 'Админ',
                'email' => 'admin@a.a',
                'password' => bcrypt('12345678'),
            ]
        ];

        DB::table('users')->insert($data);
    }
}
