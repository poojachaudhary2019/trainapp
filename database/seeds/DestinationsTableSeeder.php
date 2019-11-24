<?php

use Illuminate\Database\Seeder;

class DestinationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('destinations')->insert([
            'name' => 'Oslo',
        ], [
            'name' => 'Bergen',
        ], [
            'name' => 'Trondheim',
        ], [
            'name' => 'Drammen',
        ], [
            'name' => 'Sandeford',
        ], [
            'name' => 'Stanvanger',
        ], [
            'name' => 'Kristensand',
        ], [
            'name' => 'Bodo',
        ], [
            'name' => 'Oslo Lufthavn',
        ]);
    }
}
