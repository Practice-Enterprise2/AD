<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Address;
use App\Models\Dimension;
use App\Models\Invoice;
use App\Models\Shipment;
use App\Models\User;
use App\Notifications\ShipmentUpdated;
use App\Traits\Invoices;
use DateTime;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse; // Traits for invoices
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

    //create
    public function create(): View
    {
        // Generate list of dates for the next 7 days
        $deliveryDateStart = (new DateTime())->modify('+2 days');
        $deliveryDateEnd = (new DateTime())->modify('+8 days');
        $deliveryDates = [];
        for ($i = $deliveryDateStart; $i <= $deliveryDateEnd; $i->modify('+1 day')) {
            $deliveryDates[] = $i->format('Y-m-d');
        }

        return view('shipments.create', compact('deliveryDates'));
    }

    //store
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
        $volumetric_freight = 0;
        $volumetric_freight_tarrif = 5;
        $dense_cargo_tarrif = 4;
        $expense_excl_VAT = 0;
        $VAT_percentage = 0;
        $volumetric_freight += (($dimensions->length * $dimensions->width * $dimensions->height) / 5000);
        if ($volumetric_freight > $shipment->weight) {
            //Volumetric Air Freight rate
            $shipment->expense = $volumetric_freight * $volumetric_freight_tarrif;
        } else {
            //Dense Cargo rate
            $shipment->expense = $shipment->weight * $dense_cargo_tarrif;
        }

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
        // dd("Catch");
        $shipments = Shipment::query()->where('status', 'Awaiting Confirmation')->get();
        // dd("Catch");
        // dd($shipments);
        return view('/shipments.requests', compact('shipments'));
    }

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
        $shipment->status = 'Deleted';
        $shipment->update();
        $shipment->delete();

        return redirect()->route('shipments.index')
            ->with('success', 'Shipment deleted successfully');
    }

    public function show(Shipment $shipment): View
    {
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
    public function track(): View
    {
        // baseURL to request conversion
        $baseURL = 'http://dev.virtualearth.net/REST/v1/Locations';

        // (!) don't forget to add your bing maps key here.
        $key = 'your_bing_maps_key';

        // address should be converted here, which will be used with the baseURL to send a request.
        $country = str_ireplace(' ', '%20', request()->country);
        $street = str_ireplace(' ', '%20', request()->street);
        $state = str_ireplace(' ', '%20', request()->state);
        $locality = str_ireplace(' ', '%20', request()->city);
        $postalCode = str_ireplace(' ', '%20', request()->zipcode);

        //request URL is created here + response is retrieved with the DATA
        $findURL = $baseURL.'/'.$country.'/'.$state.'/'.$postalCode.'/'.$locality.'/'
        .$street.'?output=xml&key='.$key;
        $output = file_get_contents($findURL);
        $response = new \SimpleXMLElement($output);

        // DATA == latitude, longitude
        $latitude = $response->ResourceSets->ResourceSet->Resources->Location->Point->Latitude;
        $longitude = $response->ResourceSets->ResourceSet->Resources->Location->Point->Longitude;

        // here is the implementation to reverse geocodes into address again.
        // for debugging purposes.
        $centerPoint = $latitude.','.$longitude;
        $revGeocodeURL = $baseURL.'/'.$centerPoint.'?output=xml&key='.$key;
        $rgOutput = file_get_contents($revGeocodeURL);
        $rgResponse = new \SimpleXMLElement($rgOutput);
        $address = $rgResponse->ResourceSets->ResourceSet->Resources->Location->Address->FormattedAddress;

        // DATA is ready to be sent into view itself to be displayed within Bing Maps Javascript API.
        // returnSomething...
    }
}
