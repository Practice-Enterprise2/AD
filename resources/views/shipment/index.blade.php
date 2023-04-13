<x-app-layout>
<div class="w-screen flex flex-col justify-start items-center  text-gray-900 dark:text-gray-100">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Shipment') }}
        </h2>

     <div class="w-screen flex flex-row justify-center my-10">
     <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mx-10">
           <a href="#" class="view-status" data-status="0"> {{ __('Pending') }}</a>
        </h2>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mx-10">
        <a href="#" class="view-status" data-status="1">{{ __('Processing') }}</a>
        </h2>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mx-10">
        <a href="#" class="view-status" data-status="2">{{ __('Completed') }}</a>
        </h2>
     </div>   
     <div id="show-status" class="w-screen flex flex-col justify-start items-center">

    </div>
       
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            let viewStatus = document.querySelectorAll('.view-status');
            let statusContainer = document.getElementById('show-status');

            let status = 0;

            loadShipment(status);


            viewStatus.forEach((viewStatus) => {
                const status = viewStatus.getAttribute('data-status');
                viewStatus.addEventListener('click', (event) =>{
                    console.log("clicked");
                    event.preventDefault();
                    loadShipment(status);
                });
            });

            function loadShipment(status) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if(xhr.readyState === XMLHttpRequest.DONE)
                    {
                        if(xhr.status === 200)
                        {
                            console.log(xhr.responseText);
                            var shipments = JSON.parse(xhr.responseText);
                            var shipHtml = '';
                            for(var i = 0; i < shipments.length; i++)
                            {
                                shipHtml += `<div class="w-10/12 py-10 bg-slate-800 my-8 px-8 rounded flex flex-row">
                                                            <div class="w-8/12">
                                                                <h2>From: ` + shipments[i].from_name + '</h2>'
                                                                + '<h2>City: ' + shipments[i].from_city + '</h2>'
                                                                + '<h2>To: ' + shipments[i].to_name + '</h2>'
                                                                + '<h2>City: ' + shipments[i].to_city + '</h2>'
                                                                + '<h2>Status: ' + ((shipments[i].status === 0) ? 'Pending' : (shipments[i].status === 1) ? 'Processing' : 'Completed') + '</h2>'
                                                                +'</div>'
                                                                + '<div>'
                                                                + '<div>'
                                                                + ((shipments[i].status === 0) ? `<form action="{{route('shipment.destroy', '')}}/${shipments[i].id}" method="POST"> 
                                                                                                    @csrf
                                                                                                    @method('DELETE')
                                                                                                    <div class="flex items-center gap-4">
                                                                                                        <button class="bg-red-500 rounded px-3 py-2 my-2">{{ __('Delete') }}</button>
                                                                                                    </div>
                                                                                                </form>
                                                                                                <a href="{{route('shipment.edit', '')}}/${shipments[i].id}" class="text-blue-500 px-1 mx-4">Edit</a>` :
                                                                                                (shipments[i].status === 1) ? `<a href="{{route('contact.create')}}" class="text-red-500 px-1 mx-4">Request cancel</a>` :
                                                                                                `<form action="{{route('shipment.destroy', '')}}/${shipments[i].id}" method="POST"> 
                                                                                                    @csrf
                                                                                                    @method('DELETE')
                                                                                                    <div class="flex items-center gap-4">
                                                                                                        <button class="bg-red-500 rounded px-3 py-2 my-2">{{ __('Delete') }}</button>
                                                                                                    </div>
                                                                                                </form>
                                                                                                <a href="{{route('contact.create')}}" class="text-red-500 px-1 mx-4">I haven't receive my package...</a>`)
                                                                + `<a href="{{route('shipment.show', '')}}/${shipments[i].id}" class="text-blue-200">Detail...</a>`
                                                                + '</div>'
                                                                + '</div>'
                                                                + '</div>';
                            }
                            statusContainer.innerHTML = shipHtml;
                        }
                        else{
                            console.log('error: ' + xhr.status);
                        }
                    }
                }
                xhr.open('GET', '/shipment/status/' + status, true);
                xhr.send();
            }
        });
    </script>
</x-app-layout>