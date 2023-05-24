<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Address;
use App\Models\Depot;
use App\Models\Dimension;
use App\Models\Invoice;
use App\Models\Shipment;
use App\Models\User;
use App\Models\Waypoint;
use App\Notifications\ShipmentUpdated;
use App\Traits\Invoices;
use DateTime;
use Exception;
use Illuminate\Contracts\View\View; // Traits for invoices
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ShipmentController extends Controller
{
    use Invoices;

    public function index(): View
    {
        $shipments = Shipment::query()->whereNot('status', 'Awaiting Confirmation')
            ->whereNot('status', 'Declined')
            ->with('waypoints')
            ->get();

        return view('shipments.index', compact('shipments'));
    }

    public function create(): View
    {
        // Generate list of dates for the next 7 days
        $deliveryDateStart = (new DateTime())->modify('+2 days');
        $deliveryDateEnd = (new DateTime())->modify('+8 days');
        $deliveryDates = [];
        for ($i = $deliveryDateStart; $i <= $deliveryDateEnd; $i->modify('+1 day')) {
            $deliveryDates[] = $i->format('Y-m-d');
        }

        // good old Database-Fundamentals query here:
        $countries = Depot::join('addresses', 'depots.address_id', '=', 'addresses.id')
            ->distinct()
            ->pluck('addresses.country');

        return view('shipments.create', compact('deliveryDates', 'countries'));
    }

    public function store(): View|RedirectResponse
    {
        // Validate request
        $this->validate(request(), [
            'receiver_name' => Shipment::VALIDATION_RULES['user.name'],
            'receiver_email' => Shipment::VALIDATION_RULES['user.email'],
            'source_street' => Shipment::VALIDATION_RULES['source_address.street'],
            'source_housenumber' => Shipment::VALIDATION_RULES['source_address.house_number'],
            'source_postalcode' => Shipment::VALIDATION_RULES['source_address.postal_code'],
            'source_city' => Shipment::VALIDATION_RULES['source_address.city'],
            'source_region' => Shipment::VALIDATION_RULES['source_address.region'],
            'source_country' => Shipment::VALIDATION_RULES['source_address.country'],
            'destination_street' => Shipment::VALIDATION_RULES['destination_address.street'],
            'destination_housenumber' => Shipment::VALIDATION_RULES['destination_address.house_number'],
            'destination_postalcode' => Shipment::VALIDATION_RULES['destination_address.postal_code'],
            'destination_city' => Shipment::VALIDATION_RULES['destination_address.city'],
            'destination_region' => Shipment::VALIDATION_RULES['destination_address.region'],
            'destination_country' => Shipment::VALIDATION_RULES['destination_address.country'],
            'shipment_weight' => Shipment::VALIDATION_RULES['weight'],
            'shipment_length' => Shipment::VALIDATION_RULES['dimension.length'],
            'shipment_width' => Shipment::VALIDATION_RULES['dimension.width'],
            'shipment_height' => Shipment::VALIDATION_RULES['dimension.height'],
        ],
            [
                'receiver_name.regex' => 'The receiver name field may only contain letters and spaces.',
                'source_street.regex' => 'The source street field may only contain letters, numbers and spaces.',
                'source_postalcode.regex' => 'The source postal code field may only contain letters, numbers and spaces.',
                'source_city.regex' => 'The source city field may only contain letters and spaces.',
                'source_region.regex' => 'The source region field may only contain letters and spaces.',
                'source_country.regex' => 'The source country field may only contain letters and spaces.',
                'destination_street.regex' => 'The destination street field may only contain letters, numbers and spaces.',
                'destination_postalcode.regex' => 'The destination postal code field may only contain letters, numbers and spaces.',
                'destination_city.regex' => 'The destination city field may only contain letters and spaces.',
                'destination_region.regex' => 'The destination region field may only contain letters and spaces.',
                'destination_country.regex' => 'The destination country field may only contain letters and spaces.',
            ]);

        $source_address = Address::query()->where([
            'street' => request()->source_street,
            'house_number' => request()->source_housenumber,
            'postal_code' => request()->source_postalcode,
            'city' => request()->source_city,
            'region' => request()->source_region,
            'country' => request()->source_country,
        ])->first();

        if (! $source_address) {
            $source_address = new Address();
            $source_address->country = request()->source_country;
            $source_address->region = request()->source_region;
            $source_address->postal_code = request()->source_postalcode;
            $source_address->city = request()->source_city;
            $source_address->street = request()->source_street;
            $source_address->house_number = request()->source_housenumber;
            $source_address->push();
        }

        $destination_address = Address::query()->where([
            'street' => request()->destination_street,
            'house_number' => request()->destination_housenumber,
            'postal_code' => request()->destination_postalcode,
            'city' => request()->destination_city,
            'region' => request()->destination_region,
            'country' => request()->destination_country,
        ])->first();

        if (! $destination_address) {
            $destination_address = new Address();
            $destination_address->country = request()->destination_country;
            $destination_address->region = request()->destination_region;
            $destination_address->postal_code = request()->destination_postalcode;
            $destination_address->city = request()->destination_city;
            $destination_address->street = request()->destination_street;
            $destination_address->house_number = request()->destination_housenumber;
            $destination_address->push();
        }

        $shipment = new Shipment();
        $shipment->user_id = request()->sender_id;
        $shipment->receiver_name = request()->receiver_name;
        $shipment->receiver_email = request()->receiver_email;
        $shipment->source_address_id = $source_address->id;
        $shipment->destination_address_id = $destination_address->id;
        $shipment->type = request()->handling_type[0];

        // Convert string to time and send selected dates to db
        $shipment->shipment_date = date('Y-m-d', strtotime(request()->input('delivery_date')));
        $shipment->delivery_date = date('Y-m-d', strtotime(request()->input('shipment_date')));

        // Dimensions
        $dimensions = new Dimension();
        $dimensions->length = request()->shipment_length;
        $dimensions->width = request()->shipment_width;
        $dimensions->height = request()->shipment_height;
        $dimensions->save();
        $shipment->weight = request()->shipment_weight;
        $shipment->dimension_id = $dimensions->id;

        // Calculate shipping cost
        $shipment_distance = request()->shipment_distance;
        $volumetric_freight = 0;
        $volumetric_freight_tarrif = 5;
        $dense_cargo_tarrif = 4;
        $expense_excl_VAT = 0;
        $VAT_percentage = 0;
        $volumetric_freight += (($dimensions->length * $dimensions->width * $dimensions->height) / 5000);
        if ($volumetric_freight > $shipment->weight) {
            //Volumetric Air Freight rate
            $expense = $volumetric_freight * $volumetric_freight_tarrif * $shipment_distance;
        } else {
            //Dense Cargo rate
            $expense = $shipment->weight * $dense_cargo_tarrif * $shipment_distance;
        }
        $shipment->expense = ceil($expense);

        $shipment->status = 'Awaiting Confirmation';

        $shipment->push();
        //After the shipment has been created, we will generate an invoice with the following Trait
        $this->generateInvoice();

        $last_invoice = Invoice::query()->orderBy('id', 'desc')->first();
        $last_invoice_id = $last_invoice->id;
        //Send mail
        return redirect()->route('mail.invoices', ['invoice' => $last_invoice_id]);
    }

    public function requests(): View
    {
        $shipments = Shipment::query()->where('status', 'Awaiting Confirmation')->get();

        return view('shipments.requests', compact('shipments'));
    }

    /**
     * Decline a shipment or redirect the user to the page to confirm the
     * shipment by adding extra information.
     */
    public function evaluate(Shipment $shipment): RedirectResponse
    {
        if (request()->has('decline')) {
            $shipment->status = 'Declined';
            $shipment->update();

            return back();
        } elseif (request()->has('set')) {
            return redirect()->route('shipments.requests.evaluate.set', ['shipment' => $shipment]);
        } else {
            dd('Something gone wrong, refer Route with URI => [shipments/requests/evaluate/{shipment}]');
        }
    }

    public function showshipments()
    {
        $shipments = DB::table('shipments')
            ->join('addresses', 'shipments.destination_address_id', '=', 'addresses.id')
            ->select('shipments.receiver_name', 'shipments.id', 'shipments.user_id', 'addresses.street', 'addresses.house_number', 'addresses.postal_code', 'addresses.city', 'addresses.region', 'addresses.country', 'shipments.shipment_date', 'shipments.delivery_date', 'shipments.status')
            ->get();
        $shipments = Shipment::sortable()->paginate(20);
        $id = DB::table('shipments')
            ->select('shipments.id')
            ->get();
        $error = $this->cancel($id);

        return view('shipments',
            ['shipments' => $shipments,
                'error' => $error]);
    }

    public function showShipments_details($id)
    {
        $shipments = DB::table('shipments')
            ->join('addresses', 'shipments.destination_address_id', '=', 'addresses.id')
            ->where('shipments.id', $id)
            ->select('*')
            ->get();
        $shipment = Shipment::find($id);
        $waypointsCollection = $this->track($shipment);

        return view('shipments_details', [
            'shipments' => $shipments,
            'waypointsCollection' => $waypointsCollection,
        ]);
    }

    // Cancel a shipment with modal
    public function cancel($id)
    {
        $errorMessage = '';

        // Get status of the shipment with Id
        $shipmentToCancel = DB::select('SELECT status FROM shipments WHERE id = 1');

        if ($shipmentToCancel = 'Awaiting Confirmation' || $shipmentToCancel = 'Awaiting Pickup' || $shipmentToCancel = 'Held At Location') {
            // Can cancel ==> SUCCES
            $errorMessage = 'Succes! shipment has been canceled.';
            DB::update("UPDATE shipments SET status = 'Declined' WHERE id = ?", [$id]);
        } elseif ($shipmentToCancel = 'Delivered') {
            // Package already delivered
            $errorMessage = "Can't be canceled! Package is already delivered.";
        } elseif ($shipmentToCancel = 'Deleted') {
            // You package has been canceled by Blue Sky
            $errorMessage = "Can't be canceled! Package has been canceled by BlueSky";
        } elseif ($shipmentToCancel = 'Declined') {
            // Shipment already cancelled
            $errorMessage = "Can't be canceled! Package is already canceled";
        } elseif ($shipmentToCancel = 'Exception') {
            // wait for HR to check
            $errorMessage = 'This shipment is an exception, please wait for hr to review this!';
        } else {
            $errorMessage = "Can't be Canceled! package is in tranport and on its way";
        }
        // Wait 5 secconds before going to the return page
        // sleep(5);

        // Navigate back to shipments page and load all data
        $shipments = DB::table('shipments')
            ->join('addresses', 'shipments.destination_address_id', '=', 'addresses.id')
            ->select('shipments.receiver_name', 'shipments.id', 'shipments.user_id', 'addresses.street', 'addresses.house_number', 'addresses.postal_code', 'addresses.city', 'addresses.region', 'addresses.country', 'shipments.shipment_date', 'shipments.delivery_date', 'shipments.status')
            ->get();

        $showError = true;

        return $errorMessage;
    }

    public function edit(Shipment $shipment): View
    {
        return view('shipments.edit', compact('shipment'));
    }

    public function update(Request $request, Shipment $shipment): Redirector|RedirectResponse
    {
        $this->validate(request(), [
            'receiver_name' => Shipment::VALIDATION_RULES['user.name'],
            'receiver_email' => Shipment::VALIDATION_RULES['user.email'],
            'source_street' => Shipment::VALIDATION_RULES['source_address.street'],
            'source_housenumber' => Shipment::VALIDATION_RULES['source_address.house_number'],
            'source_postalcode' => Shipment::VALIDATION_RULES['source_address.postal_code'],
            'source_city' => Shipment::VALIDATION_RULES['source_address.city'],
            'source_region' => Shipment::VALIDATION_RULES['source_address.region'],
            'source_country' => Shipment::VALIDATION_RULES['source_address.country'],
            'destination_street' => Shipment::VALIDATION_RULES['destination_address.street'],
            'destination_housenumber' => Shipment::VALIDATION_RULES['destination_address.house_number'],
            'destination_postalcode' => Shipment::VALIDATION_RULES['destination_address.postal_code'],
            'destination_city' => Shipment::VALIDATION_RULES['destination_address.city'],
            'destination_region' => Shipment::VALIDATION_RULES['destination_address.region'],
            'destination_country' => Shipment::VALIDATION_RULES['destination_address.country'],
        ],
            [
                'receiver_name.regex' => 'The receiver name field may only contain letters and spaces.',
                'source_street.regex' => 'The source street field may only contain letters, numbers and spaces.',
                'source_postalcode.regex' => 'The source postal code field may only contain letters, numbers and spaces.',
                'source_city.regex' => 'The source city field may only contain letters and spaces.',
                'source_region.regex' => 'The source region field may only contain letters and spaces.',
                'source_country.regex' => 'The source country field may only contain letters and spaces.',
                'destination_street.regex' => 'The destination street field may only contain letters, numbers and spaces.',
                'destination_postalcode.regex' => 'The destination postal code field may only contain letters, numbers and spaces.',
                'destination_city.regex' => 'The destination city field may only contain letters and spaces.',
                'destination_region.regex' => 'The destination region field may only contain letters and spaces.',
                'destination_country.regex' => 'The destination country field may only contain letters and spaces.',
            ]);

        $source_address = Address::query()->where([
            'id' => $shipment->source_address_id,
        ])->first();

        $source_address->update([
            'country' => request()->source_country,
            'region' => request()->source_region,
            'postal_code' => request()->source_postalcode,
            'city' => request()->source_city,
            'street' => request()->source_street,
            'house_number' => request()->source_housenumber,
        ]);

        $destination_address = Address::query()->where([
            'id' => $shipment->destination_address_id,
        ])->first();

        $destination_address->update([
            'country' => request()->destination_country,
            'region' => request()->destination_region,
            'postal_code' => request()->destination_postalcode,
            'city' => request()->destination_city,
            'street' => request()->destination_street,
            'house_number' => request()->destination_housenumber,
        ]);

        $shipment->update([
            'receiver_name' => request()->receiver_name,
            'receiver_email' => request()->receiver_email,
            'status' => request()->status,
            'type' => request()->handling_type[0],
        ]);

        if (request()->status == 'Awaiting Confirmation') {
            $waypoints = Waypoint::query()->where('shipment_id', $shipment->id)->get();
            foreach ($waypoints as $waypoint) {
                $waypoint->delete();
            }
        }

        if ($shipment->wasChanged()) {
            $shipmentChanges = $shipment->getChanges();
            $source_user = User::query()->where('id', $shipment->user_id)->first();
            $source_user->notify(new ShipmentUpdated($shipment, $shipmentChanges));
        }

        return redirect()->route('shipments.index')
            ->with('success', 'Shipment updated successfully');
    }

    public function destroy(Shipment $shipment): Redirector|RedirectResponse
    {
        $this->authorize('delete', $shipment);

        $shipment->status = 'Deleted';
        $shipment->update();
        $shipment->delete();

        return redirect()->route('shipments.index')
            ->with('success', 'Shipment deleted successfully');
    }

    public function show(Shipment $shipment): View
    {
        $this->authorize('view', $shipment);

        return view('shipments.show', compact('shipment'));
    }

    public function sendInvoiceMail(Invoice $invoice): View|RedirectResponse
    {
        $subject = 'Your invoice for your latest shipment.';
        $user_id = auth()->user()->id;
        $emailke = auth()->user()->email;
        $name = auth()->user()->name;
        $invoice_id = $invoice->id;
        $shipment_id = DB::table('invoices')->select('shipment_id')->where('id', $invoice_id)->value('id');
        $shipment_user_id = DB::table('shipments')->select('user_id')->where('id', $shipment_id)->value('id');
        $shipment_weight = DB::table('shipments')->select('weight')->where('id', $shipment_id)->value('weight');
        if ($shipment_user_id != $user_id) {
            return redirect()->route('home');
        }
        $data = [
            'subject' => $subject,
            'name' => $name,
            'weight' => $shipment_weight,
            'total_price' => $invoice->total_price,
            'invoice_code' => $invoice->invoice_code,
        ];
        try {
            Mail::to('r0902342@student.thomasmore.be')->send(new InvoiceMail($data));
            //For demonstration purposes I am using my email for now, please do not spam my email. This will be change to the above variable $emailke
            return view('invoices.invoice_generated', compact('data'));
        } catch (Exception $th) {
            return response($th);
        }
    }

    // Bing Maps Locations API
    // Template API that CONVERTS ADDRESS TO GEOCODE(latitude, longitude) to be able to display each waypoint relevant to the shipment in concern.
    public function track(Shipment $shipment)
    {
        $waypoints = $shipment->waypoints;
        $waypoints_geocodes = collect([]);

        // ADD YOUR API KEY TO ".env" file.
        $bingmaps_api_key = env('BINGMAPS_KEY');
        // baseURL to request conversion
        $baseURL = 'http://dev.virtualearth.net/REST/v1/Locations';
        $waypointsCollection = collect();
        //dd($shipment->waypoints);
        // (!) don't forget to add your bing maps key here.
        $key = 'AsGfeENZ_hYN25e91OFGuGbFUm2PHIQrKbvKqg3O1XmJeVxfTgXk8h1p38nbJn1S';
        // address should be converted here, which will be used with the baseURL to send a request.

        $country = str_ireplace(' ', '%20', $shipment->waypoints[0]->current_address->country);
        $street = str_ireplace(' ', '%20', $shipment->waypoints[0]->current_address->street);
        $housenr = str_ireplace(' ', '%20', $shipment->waypoints[0]->current_address->house_number);
        $locality = str_ireplace(' ', '%20', $shipment->waypoints[0]->current_address->city);
        $postalCode = str_ireplace(' ', '%20', $shipment->waypoints[0]->current_address->postal_code);

        //request URL is created here + response is retrieved with the DATA
        $findURL = $baseURL.'/'.$country.'/'.$housenr.'/'.$postalCode.'/'.$locality.'/'
        .$street.'?output=xml&key='.$key;

        dump($findURL);

        $output = file_get_contents($findURL);
        //dd($findURL);
        $response = new \SimpleXMLElement($output);

        $latitude = $response->ResourceSets->ResourceSet->Resources->Location->Point->Latitude->__toString();
        $longitude = $response->ResourceSets->ResourceSet->Resources->Location->Point->Longitude->__toString();

        $waypoints_geocodes[count($waypoints)] = [
            'type' => 'next_address',
            'waypoint_id' => $waypoints[count($waypoints) - 1]->id,
            'waypoint_status' => $waypoints[count($waypoints) - 1]->status,
            'waypoint' => $waypoints[count($waypoints) - 1],
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];

        // here is the implementation to reverse geocodes into address again.
        // for debugging purposes.
        $centerPoint = $latitude.','.$longitude;
        $revGeocodeURL = $baseURL.'/'.$centerPoint.'?output=xml&key='.$key;
        $rgOutput = file_get_contents($revGeocodeURL);
        $rgResponse = new \SimpleXMLElement($rgOutput);
        $address = $rgResponse->ResourceSets->ResourceSet->Resources->Location->Address->FormattedAddress;
        $coords = [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];
        $waypointsCollection->push($coords);

        for ($i = 0; $i < count($shipment->waypoints); $i++) {
            $country2 = str_ireplace(' ', '%20', $shipment->waypoints[$i]->next_address->country);
            $street2 = str_ireplace(' ', '%20', $shipment->waypoints[$i]->next_address->street);
            $housenr2 = str_ireplace(' ', '%20', $shipment->waypoints[$i]->next_address->house_number);
            $locality2 = str_ireplace(' ', '%20', $shipment->waypoints[$i]->next_address->city);
            $postalCode2 = str_ireplace(' ', '%20', $shipment->waypoints[$i]->next_address->postal_code);
            $status = $shipment->waypoints[$i]->status;
            //request URL is created here + response is retrieved with the DATA
            $findURL2 = $baseURL.'/'.$country2.'/'.$housenr2.'/'.$postalCode2.'/'.$locality2.'/'
            .$street2.'?output=xml&key='.$key;
            $output2 = file_get_contents($findURL2);
            //dd($findURL);
            $response2 = new \SimpleXMLElement($output2);

            // DATA == latitude, longitude
            $latitude2 = $response2->ResourceSets->ResourceSet->Resources->Location->Point->Latitude;
            $longitude2 = $response2->ResourceSets->ResourceSet->Resources->Location->Point->Longitude;

            // here is the implementation to reverse geocodes into address again.
            // for debugging purposes.
            $centerPoint2 = $latitude2.','.$longitude2;
            $revGeocodeURL2 = $baseURL.'/'.$centerPoint2.'?output=xml&key='.$key;
            $rgOutput2 = file_get_contents($revGeocodeURL2);
            $rgResponse2 = new \SimpleXMLElement($rgOutput2);
            $address2 = $rgResponse2->ResourceSets->ResourceSet->Resources->Location->Address->FormattedAddress;
            $coords = [
                'latitude' => $latitude2,
                'longitude' => $longitude2,
                'status' => $status,
            ];
            $waypointsCollection->push($coords);
        }

        // DATA is ready to be sent into view itself to be displayed within Bing Maps Javascript API.
        // returnSomething...

        return $waypointsCollection;
    }
}

namespace App\Http\Controllers;

use App\Mail\shipmentMail;
use App\Models\Address;
use App\Models\Shipment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ShipmentController extends Controller
{
    //
    use AuthorizesRequests, ValidatesRequests;

    public function insert(Request $request)
    {
        $ShipmentStreet = $request->input('Street');
        $ShipmentHouseNr = $request->input('HouseNr');
        $ShipmentPostalCode = $request->input('PostalCode');
        $ShipmentCity = $request->input('City');
        $ShipmentRegion = $request->input('Region');
        $ShipmentCountry = $request->input('Country');
        $current_date_time = date('Y-m-d H:i:s');
        $updated_date_time = date('Y-m-d H:i:s');
        DB::insert('insert into addresses values(?, ?, ?, ?, ?, ?, ?, ?, ?)', [null, $ShipmentStreet, $ShipmentHouseNr, $ShipmentPostalCode, $ShipmentCity, $ShipmentRegion, $ShipmentCountry, $current_date_time, $updated_date_time]);
        $AddressID = DB::getPdo()->lastInsertId();
        $ShipmentName = $request->input('FirstName').' '.$request->input('LastName');
        $ShipmentStatus = 1;
        $ShipmentWeight = $request->input('Weight');
        $ShipmentType = $request->input('Type');
        $shippingDate = $request->input('shippingDate');
        if ($ShipmentType == 1) {
            $expense = 5;
        } else {
            $expense = 10;
        }
        $customerID = 1;
        //$sourceAddress = DB::select('select address_id from customers where id = ?',[1]);
        $sourceAddress = DB::table('customers')->where('id', $customerID)->value('address_id');
        DB::insert('insert into shipments values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [null, $customerID, $ShipmentName, $sourceAddress, $AddressID, $shippingDate, $shippingDate, $ShipmentStatus, $expense, $ShipmentWeight, $ShipmentType, $current_date_time, $updated_date_time, 0, null]);

        // Mail::to('killian.serluppens@gmail.com')->send(new shipmentMail());

        $id = DB::table('shipments')->latest()->value('id');

        $data = Shipment::find($id);

        $address1 = Address::find($data->source_address_id);
        $address2 = Address::find($data->destination_address_id);

        return view('shipmentOverview', ['data' => $data], ['srcAddress' => $address1, 'dstAddress' => $address2]);

    }

    public function getShipmentInfo($id)
    {
        $data = Shipment::find($id);

        $address1 = Address::find($data->source_address_id);
        $address2 = Address::find($data->destination_address_id);

        return view('/shipmentOverview/', ['data' => $data], ['srcAddress' => $address1, 'dstAddress' => $address2]);

    }
}
