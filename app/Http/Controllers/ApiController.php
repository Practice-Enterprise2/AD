<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Response;

class ApiController extends Controller{

  public function apiCall() {

    if(!request()->has("query") || strlen(request()->query("query")) < 3){
      //throw error
      //intentional error 
      return Response::json(['error' => "Bad Request"],400);
  }
    $search = request()->query('query');
 
    $response = Http::get('https://airlabs.co/api/v9/suggest', [
      'api_key' => '5d4af27c-aa83-440d-93bc-edf75b85a639',
      'query' => $search
      

  ]);
   
  return collect($response["response"]["airports"])->map(function ($airport) { return collect($airport)->only(['name', 'iata_code']); });
  }
}

?>
