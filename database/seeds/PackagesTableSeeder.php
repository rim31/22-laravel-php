<?php

use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            'name' => 'basic',
            'currency' => 'EUR',
            'quantity' => '1',
            'sku' => '1',
            'price' => '50',
            'shipping' => '0',
            'tax' => '10',
        ]);
        DB::table('packages')->insert([
            'name' => 'premium',
            'currency' => 'EUR',
            'quantity' => '1',
            'sku' => '2',
            'price' => '80',
            'shipping' => '0',
            'tax' => '16',
        ]);
        DB::table('packages')->insert([
            'name' => 'excelium',
            'currency' => 'EUR',
            'quantity' => '1',
            'sku' => '3',
            'price' => '150',
            'shipping' => '0',
            'tax' => '30',
        ]);
        DB::table('packages')->insert([
            'name' => 'lorem ipsum',
            'currency' => 'EUR',
            'quantity' => '1',
            'sku' => '4',
            'price' => '300',
            'shipping' => '0',
            'tax' => '60',
        ]);
        DB::table('packages')->insert([
            'name' => 'personalize',
            'currency' => 'EUR',
            'quantity' => '1',
            'sku' => '5',
            'price' => '1000',
            'shipping' => '0',
            'tax' => '200',
        ]);
    }
}
