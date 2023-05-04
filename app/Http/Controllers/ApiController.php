<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function apiCall(): JsonResponse
    {
        if (! request()->has('query') || strlen(request()->query('query')) < 3) {
            //throw error
            //intentional error
            return response()->json(['error' => 'Bad Request'], 400);
        }

        $search = request()->query('query');

        $airlabsKey = getenv('AIRLAPS_KEY');

        $response = Http::get('https://airlabs.co/api/v9/suggest', [
            'api_key' => $airlabsKey,
            'query' => $search,
        ]);

        return collect($response['response']['airports'])
            ->filter(function ($airport) {
                return array_key_exists('iata_code', $airport);
            })
            ->map(function ($airport) {
                return collect($airport)->only(['name', 'iata_code']);
            });
    }
}
