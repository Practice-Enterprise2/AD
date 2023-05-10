<x-app-layout>
    <div class="flex-grow p-8 dark:bg-gray-900 dark:text-white">
        <h1 class="text-2xl font-bold mb-8">Dashboard</h1>
      
        <div class="flex mb-8">
          <div class="w-1/3 p-4 bg-gray-800 rounded shadow-lg mr-4 text-xl font-bold">
            <h1 class="p-4 text-white font-bold text-2xl underline">Amount of Shipments</h1>
            <div class="text-7xl font-bold text-center mt-12">{{ $countUser }} </div>
          </div>
          <div class="w-1/3 p-4 bg-gray-800 rounded shadow-lg mr-4">
            <div class="grid grid-cols-2 gap-2 text-sm">
                <h1 class="col-span-2 p-4 text-white font-bold text-2xl underline">Shipments per status</h1>
                
                <div class="mx-auto font-bold text-bold">
                  <div class="">Awaiting pickup:</div>
                </div>
                <div class="mx-auto">
                    <div class=""> {{ $countAwaPick }} </div>
                </div>

                <div class="mx-auto font-bold text-bold">
                    <div class="">Awaiting confirmation:</div>
                </div>
                <div class="mx-auto">
                    <div class="">{{$countAwaConf}}</div>
                </div>
                
                <div class="mx-auto font-bold">
                    <div class="">In Transit:</div>
                </div>
                <div class="mx-auto">
                    <div class="">{{$countInTran}}</div>
                </div>
                
                <div class="mx-auto font-bold">
                    <div class="">Out for Delivery:</div>
                </div>
                <div class="mx-auto ">
                    <div class="">{{$countOutFDel}}</div>
                </div>
                
                <div class="mx-auto font-bold">
                    <div class="">Delivered:</div>
                </div>
                <div class="mx-auto">
                    <div class=""> {{$countDelivered}} </div>
                </div>
                
                <div class="mx-auto font-bold">
                    <div class="">Held at location:</div>
                </div>
                <div class="mx-auto">
                    <div class=""> {{ $countHaL }} </div>
                </div>
                
                <div class="mx-auto font-bold">
                    <div class="">Exeption:</div>
                </div>
                <div class="mx-auto">
                    <div class=""> {{$countEx}}  </div>
                </div>
                
                <div class="mx-auto font-bold">
                    <div class="">Deleted:</div>
                </div>
                <div class="mx-auto">
                    <div class="">{{$countDel}} </div>
                </div>
                
                <div class="mx-auto font-bold">
                    <div class="">Declined:</div>
                </div>
                <div class="mx-auto">
                    <div class=""> {{$countDec}}</div>
                </div>
              </div>
              
          </div>
          <div class="w-1/3 mx-quto bg-gray-800 rounded shadow-lg text-lg font-bold">ADD
            <div class="text-sm font-normal">add</div>
          </div>
        </div>
      
        <div class="flex mb-8">
          <div class="w-1/2 p-4 bg-gray-800 rounded shadow-lg mr-4">Your Invoices
          </div>
          <div class="w-1/2 p-4 bg-gray-800 rounded shadow-lg">Panel 5</div>
        </div>
      
      </div>
      
</x-app-layout>


