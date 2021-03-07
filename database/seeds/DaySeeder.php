<?php

use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $array = [
            ['name' => 'Mon','label' => 'monday'],
            ['name' => 'Tue','label' => 'tuesday'],
            ['name' => 'Wed','label' => 'wednesday'],
            ['name' => 'Thu','label' => 'thursday'],
            ['name' => 'Fri','label' => 'friday'],
            ['name' => 'Sat','label' => 'saturday'],
            ['name' => 'Sun','label' => 'sunday'],
        ];
        DB::table('days')->insert($array);
    }
}
