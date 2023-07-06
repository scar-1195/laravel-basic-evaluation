<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->states();
    }

    public function states()
    {
        FacadesDB::table('states')->insert([
            ['id' => 1, 'state' => 'in progress'],
            ['id' => 2, 'state' => 'holding'],
            ['id' => 3, 'state' => 'finished'],
        ]);
    }
}
