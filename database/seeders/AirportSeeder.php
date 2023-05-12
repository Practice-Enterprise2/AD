<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Airport;
use GuzzleHttp\Client;
//composer package
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    protected $country;

    public function __construct($country)
    {
        $this->country = $country;
    }

        //only 6 airport is enough for out project?
        // $airlab_objects = array_slice(json_decode($response->getBody()->getContents())->response, 0, 6);
        // dd($airlab_objects);

    public function run(): void
    {
        $airLabs_countryCode = config('country_codes')[strtoupper($this->country)];

        $airports_added = 0;
        $index = 0;

        while ($airports_added != 2) {
            $client = new Client();
            $response = $client->get("https://airlabs.co/api/v9/airports?country_code={$airLabs_countryCode}&api_key={YOUR_AIRLABS_KEY_HERE}");
            $airlab_object = array_slice(json_decode($response->getBody()->getContents())->response, $index, 1);

            $client = new Client();
            $bingMaps_airportObject = $client->get("https://dev.virtualearth.net/REST/v1/LocationRecog/{$airlab_object[0]->lat},{$airlab_object[0]->lng}?key={YOUR_BINGMAPS_KEY_HERE}");

            // $airport_address = json_decode($bingMaps_airportObject->getBody()->getContents())->resourceSets[0]->resources[0]->addressOfLocation[0];
            // dump($airport_address);

            $airport_address_info = json_decode($bingMaps_airportObject->getBody()->getContents())->resourceSets[0]->resources[0]->businessesAtLocation[0];
            $airport_address = $airport_address_info->businessAddress;
            dump($airport_address_info);

            // if no street presented within the airport address object (which happened a couple times.)
            if (! isset($airport_address->addressLine)) {
                $index++;

                continue;
            }

            $airport = new Airport();
            $airport->iata_code = $airlab_object[0]->iata_code;
            $airport->name = $airlab_object[0]->name;
            $airport->land = $this->country;

            $address = new Address();
            $address->street = $airport_address->addressLine;
            $address->house_number = '';
            $address->postal_code = isset($airport_address->postalCode) ? $airport_address->postalCode : '';
            $address->city = $airport_address->locality;
            $address->region = isset($airport_address->adminDivision) ? $airport_address->adminDivision : $this->country;
            $address->country = $this->country;
            $address->push();

            $airport->address_id = $address->id;
            $airport->push();

            $airports_added++;
            $index++;
        }
    }
}
