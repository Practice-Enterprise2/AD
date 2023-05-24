<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\AirlineContract;
use App\Models\airport;
use App\Models\Contract;
use Illuminate\Support\Facades\DB;

class EditContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function alter()
    {
        $id = $_GET['id'];
        $airlineID = $_GET['airline'];
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];
        $price = $_GET['price'];
        $departure = $_GET['departure_location'];
        $destination = $_GET['destination_location'];
        $affected = DB::table('contracts')->where('id', $id)->update(
            ['airline_id' => $airlineID, 'start_date' => $start_date, 'end_date' => $end_date, 'price' => $price,  'depart_airport_id' => $departure, 'destination_airport_id' => $destination]);
        if (isset($_GET['deactivate'])) {
            $affected = DB::table('contracts')->where('id', $id)->update(['is_active' => 0]);
        }
        if (isset($_GET['reactivate'])) {
            $affected = DB::table('contracts')->where('id', $id)->update(['is_active' => 1]);
        }
        unset($_GET);
        ?>
                   <script>
                    this.location.replace("/edit?q=<?php echo $id; ?>");
                   </script>
                   <?php

    }

    public function simpleV2()
    {
        $id = 1;
        $contracts = null;
        if (! isset($_GET['q'])) {
            $tmp = Contract::all();
            $id = $tmp[0]->id;
                $_GET['q'] = $id;
        }

        if (is_numeric($_GET['q'])) {
            $id = $_GET['q'];
        }
        $contracts = AirlineContract::where('id', $id)->get();
        $airports = airport::all();

        $airlines = Airline::all();

        if (count($contracts) != 0) {
            return view('edit_contract', compact('contracts', 'airports', 'airlines'));
        } else {
            ?>
             <script>
                   this.location.replace("/edit");
            </script>
            <?php
        }
    }
}
