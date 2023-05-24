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
        // please add the address within the //CountryName below.
        // DO MIND TO add addresses with which CITIES SHOULD HAVE AIRPORTS
        $addresses = collect([
            // Australia
            ['street' => 'The Esplanade', 'house_number' => '', 'postal_code' => '4870', 'city' => 'Cairns', 'region' => 'Queensland', 'country' => 'Australia'],
            ['street' => 'St Georges Terrace', 'house_number' => '', 'postal_code' => '6000', 'city' => 'Perth', 'region' => 'Western Australia', 'country' => 'Australia'],
            ['street' => 'North Terrace', 'house_number' => '', 'postal_code' => '5000', 'city' => 'Adelaide', 'region' => 'South Australia', 'country' => 'Australia'],

            // Türkiye
            ['street' => 'Abdülhakhamit Cd.', 'house_number' => '8', 'postal_code' => '34435', 'city' => 'Istanbul', 'region' => 'Istanbul', 'country' => 'Türkiye'],
            ['street' => 'Atatürk Cd.', 'house_number' => '21', 'postal_code' => '07400', 'city' => 'Alanya', 'region' => 'Antalya', 'country' => 'Türkiye'],
            ['street' => 'Yalı Cd.', 'house_number' => '23', 'postal_code' => '48400', 'city' => 'Bodrum', 'region' => 'Muğla', 'country' => 'Türkiye'],

            // Belgium
            ['street' => 'Avenue Louise', 'house_number' => '105', 'postal_code' => '1000', 'city' => 'Brussels', 'region' => '', 'country' => 'Belgium'],
            ['street' => 'Oude Koornmarkt', 'house_number' => '31', 'postal_code' => '2000', 'city' => 'Antwerp', 'region' => 'Flanders', 'country' => 'Belgium'],
            ['street' => 'Grote Markt', 'house_number' => '', 'postal_code' => '2800', 'city' => 'Mechelen', 'region' => 'Flanders', 'country' => 'Belgium'],

            // Italy
            ['street' => 'Piazza San Marco', 'house_number' => '', 'postal_code' => '30124', 'city' => 'Venice', 'region' => 'Veneto', 'country' => 'Italy'],
            ['street' => 'Via del Corso', 'house_number' => '', 'postal_code' => '00187', 'city' => 'Rome', 'region' => 'Lazio', 'country' => 'Italy'],
            ['street' => 'Via Montenapoleone', 'house_number' => '', 'postal_code' => '20121', 'city' => 'Milan', 'region' => 'Lombardy', 'country' => 'Italy'],

            // Spain
            ['street' => 'Plaza Mayor', 'house_number' => '', 'postal_code' => '28012', 'city' => 'Madrid', 'region' => '', 'country' => 'Spain'],
            ['street' => 'Las Ramblas', 'house_number' => '', 'postal_code' => '08002', 'city' => 'Barcelona', 'region' => 'Catalonia', 'country' => 'Spain'],
            ['street' => 'Carrer de Montcada', 'house_number' => '', 'postal_code' => '08003', 'city' => 'Barcelona', 'region' => 'Catalonia', 'country' => 'Spain'],

            // Portugal
            ['street' => 'Rua Augusta', 'house_number' => '', 'postal_code' => '1100-053', 'city' => 'Lisbon', 'region' => '', 'country' => 'Portugal'],
            ['street' => 'Rua Santa Catarina', 'house_number' => '', 'postal_code' => '4000-447', 'city' => 'Porto', 'region' => '', 'country' => 'Portugal'],

            // France
            ['street' => 'Rue de la Paix', 'house_number' => '5', 'postal_code' => '75001', 'city' => 'Paris', 'region' => 'Île-de-France', 'country' => 'France'],
            ['street' => 'Rue des Remparts', 'house_number' => '3', 'postal_code' => '06400', 'city' => 'Cannes', 'region' => 'Provence-Alpes-Côte d\'Azur', 'country' => 'France'],

            // Germany
            ['street' => 'Friedrichstraße', 'house_number' => '176-179', 'postal_code' => '10117', 'city' => 'Berlin', 'region' => '', 'country' => 'Germany'],
            ['street' => 'Münchner Straße', 'house_number' => '', 'postal_code' => '60329', 'city' => 'Frankfurt', 'region' => 'Hesse', 'country' => 'Germany'],
        ]);

        $temp_country = '';
        foreach ($addresses as $address_object) {
            $address = new Address();
            $depot = new Depot();

            $address->street = $address_object['street'];
            $address->house_number = $address_object['house_number'];
            $address->postal_code = $address_object['postal_code'];
            $address->city = $address_object['city'];
            $address->region = $address_object['region'];
            $address->country = $address_object['country'];
            $address->push();

            $depot->code = intval($address->postal_code) + 10000;
            $depot->address_id = $address->id;
            $depot->size = rand(100, 1000);
            $depot->push();

            // Seeding the airports table with it's addresses.
            if (env('AIRLABS_KEY')) {
                if ($address->country != $temp_country) {
                    $temp_country = $address->country;
                    $airport_seeder = new AirportSeeder($temp_country);
                    $airport_seeder->run();
                }
            }
        }
    }
}
