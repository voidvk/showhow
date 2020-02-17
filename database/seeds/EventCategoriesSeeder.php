<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        $cName = 'Без категории';
        $categories[] = [
            'title' => $cName,
            'slug' => Str::slug($cName),
        ];
        for ($i = 1; $i<= 10; $i++)
        {
            $cName = 'Категория #'.$i;
            $categories[] = [
                'title' => $cName,
                'slug' => Str::slug($cName),
            ];
        }
        DB::table('event_categories')->insert($categories);
    }
}
