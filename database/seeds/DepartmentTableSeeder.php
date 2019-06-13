<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'department' => 'Infotech',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
