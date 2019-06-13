<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'category' => 'Management',
            'days' => '30',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
