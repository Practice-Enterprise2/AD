
<x-app-layout>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    var i = 0; 
  </script>

<!-- Modal -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="cancelModal">
  <div class="flex items-center justify-center min-h-screen p-4 text-center">
    <!-- Modal Background -->
    <div class="fixed inset-0 bg-black opacity-75"></div>
    <!-- Modal Content -->
    <div class="bg-white w-full max-w-md mx-auto rounded shadow-lg p-6 relative">
      <h1 class="text-2xl font-bold mb-4">Confirmation</h1>    
      <p class="mb-4">Are you sure you want to cancel?</p>
      <div class="flex justify-center  bottom-0 w-full pb-6 relative">
        <a href="#"><button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mr-2" id="confirmCancelButton">
          Yes
        </button></a>
        <button class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded ml-2" id="cancelCancelButton">
          No
        </button>
      </div>
      
    </div>
  </div>
</div>

<div class="bg-gray-900 py-10">
    <div class="container mx-auto px-4">
      <h1 class="text-3xl font-bold text-white mb-10">Hello {{$username}} These are your shipments </h1>
      <div class="shadow overflow-hidden border-b border-gray-800 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-800">
          <thead class="bg-gray-800">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Name</th>
{{--               <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Source Address</th> --}}
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Destination Address</th> 
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Shipment Date</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Delivery Date</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Buttons</th>
            </tr>
          </thead>
          
          <tbody class="bg-gray-900 divide-y divide-gray-800">
            @foreach ($shipment as $data)                       
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-white"> {{$data->name}} </div>
              </td>

{{--          <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-white"> {{ $data->source_address_id}}</div>
              </td>
--}}    
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-white"> {{$data->street}} {{$data->house_number}} &nbsp;&nbsp; {{$data->city}} {{$data->postal_code}} &nbsp;&nbsp; {{$data->region}}  {{$data->country}}  </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-white">{{$data->shipment_date}}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-white">{{$data->delivery_date}}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                @if ($data->status == 0)
                    <div class="text-sm text-white border-2 bg-gray-500 border-gray-900 rounded-md text-center">Package Lost</div>                
                @elseif ($data->status == 1)
                    <div class="text-sm text-white border-2 bg-blue-500 border-blue-700 rounded-md text-center">Awaiting Confirmation</div>               
                @elseif ($data->status == 2)
                    <div class="text-sm text-white border-2 bg-green-500 border-green-700 rounded-md text-center">Order Confirmed</div>       
                @elseif ($data->status == 3)
                    <div class="text-sm text-white border-2 bg-emerald-500 border-emerald-700 rounded-md text-center">In transit</div>     
                @elseif ($data->status == 4)
                    <div class="text-sm text-white border-2 bg-orange-500 border-orange-700 rounded-md text-center">Waiting at pick up point</div>          
                @elseif ($data->status == 5)
                    <div class="text-sm text-white border-2 bg-red-400 border-red-900 rounded-md text-center">Cancelled</div>                
                @endif                               
              </td>
              <td class="px-6 py-4 whitespace-nowrap">

                <button class="rounded-md border-2 border-red-600 px-3 text-white" id="cancelButton{{$data->id}}">Cancel</button>

           



{{--                 <a href="{{ url('shipmentOverview/'.$data->id)}}"><button class="rounded-md border-2 border-blue-600 px-3 text-white">Info</button></a> --}}              
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <script>
              
        var cancelButton = document.getElementById('cancelButton'+{{$data->id}});
        var modal = document.getElementById('cancelModal');
        var confirmCancelButton = document.getElementById('confirmCancelButton');
        var cancelCancelButton = document.getElementById('cancelCancelButton');

        cancelButton.addEventListener('click', function() {
            modal.classList.remove('hidden');
        console.log(cancelButton);   

        });                   
        confirmCancelButton.addEventListener('click', function() {
          // Add cancelation code to controller.
          console.log("cancel button: " + cancelButton);
          modal.classList.add('hidden');                    
        });
        cancelCancelButton.addEventListener('click', function() {
          modal.classList.add('hidden');
        });

      
  
      </script>




<!-- JavaScript to show/hide the modal -->


{{-- <script>
  // Get modal and buttons
  var id = "{{$data->id}}";
  var cancelButton = document.getElementById('cancelButton');

  var modal = document.getElementById('cancelModal');
  var confirmCancelButton = document.getElementById('confirmCancelButton');
  var cancelCancelButton = document.getElementById('cancelCancelButton');
  
  // Show modal when cancel button is clicked
  cancelButton.addEventListener('click', function() {
     console.log("Hello, cancel button!");
    modal.classList.remove('hidden');
  });
  
  // Hide modal and perform cancellation logic when "Yes" button is clicked
  confirmCancelButton.addEventListener('click', function() {
    // Perform cancellation logic here
    // Hide modal
    modal.classList.add('hidden');
  });

  // Hide modal when "No" button is clicked
  cancelCancelButton.addEventListener('click', function() {
    modal.classList.add('hidden');
  });
  </script> --}}

</x-app-layout>

