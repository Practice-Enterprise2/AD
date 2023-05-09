<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Depot;
use Illuminate\Database\Seeder;

class DepotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addresses = collect([
            ['street' => 'Rue de la Paix', 'house_number' => '5', 'postal_code' => '75001', 'city' => 'Paris', 'region' => 'Île-de-France', 'country' => 'France'],
            ['street' => 'Friedrichstraße', 'house_number' => '176-179', 'postal_code' => '10117', 'city' => 'Berlin', 'region' => '', 'country' => 'Germany'],
            ['street' => 'Piazza San Marco', 'house_number' => '', 'postal_code' => '30124', 'city' => 'Venice', 'region' => 'Veneto', 'country' => 'Italy'],
            ['street' => 'Plaza Mayor', 'house_number' => '', 'postal_code' => '28012', 'city' => 'Madrid', 'region' => '', 'country' => 'Spain'],
            ['street' => 'Herengracht', 'house_number' => '450', 'postal_code' => '1017 CA', 'city' => 'Amsterdam', 'region' => 'North Holland', 'country' => 'Netherlands'],
            ['street' => 'Rua Augusta', 'house_number' => '', 'postal_code' => '1100-048', 'city' => 'Lisbon', 'region' => '', 'country' => 'Portugal'],
            ['street' => 'Kärntner Straße', 'house_number' => '', 'postal_code' => '1010', 'city' => 'Vienna', 'region' => '', 'country' => 'Austria'],
            ['street' => 'Rue du Rhône', 'house_number' => '', 'postal_code' => '1204', 'city' => 'Geneva', 'region' => 'Geneva', 'country' => 'Switzerland'],
            ['street' => 'Strøget', 'house_number' => '', 'postal_code' => '1050', 'city' => 'Copenhagen', 'region' => '', 'country' => 'Denmark'],
            ['street' => 'Storgata', 'house_number' => '', 'postal_code' => '0184', 'city' => 'Oslo', 'region' => '', 'country' => 'Norway'],
        ]);

        foreach ($addresses as $address_item) {
            $address = new Address();
            $depot = new Depot();

            $address->street = $address_item['street'];
            $address->house_number = $address_item['house_number'];
            $address->postal_code = $address_item['postal_code'];
            $address->city = $address_item['city'];
            $address->region = $address_item['region'];
            $address->country = $address_item['country'];
            $address->push();

            $depot->code = intval($address->postal_code) + 10000;
            $depot->address_id = $address->id;
            $depot->size = rand(100, 1000);
            $depot->push();
        }
    }
}
