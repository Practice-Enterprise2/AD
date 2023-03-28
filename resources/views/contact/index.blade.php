<x-app-layout>
<div class="w-screen flex flex-col justify-start items-center text-gray-900 dark:text-gray-100">
<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Customer\'s contact Page') }}
        </h2>
<!-- @foreach($contacts as $contact)
<div class="w-10/12 py-10 bg-slate-800 my-8 px-8 rounded flex flex-col items-center">
<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 -mt-8">
           @if($contact->subject == 'request-cancel')
            {{ __('Request cancel shipment') }}
            @elseif($contact->subject == 'package-location')
            {{ __('Where is my package') }}
            @elseif($contact->subject == 'received-no-package')
            {{ __('I haven\'t receive my packages') }}
            @else
            {{ __('Other problem') }}
           @endif
        </h2>
<div class="w-full">
    <div class="w-8/12">
        <h2>Email: {{ $contact->email }}</h2>
        <h2>Shipment ID: {{ $contact->shipment_id }}</h2>
        <a href="{{route('contact.show', $contact->id)}}" class="text-blue-200">Detail...</a>
        <form
                    action="{{ route('contact.destroy', $contact->id) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex items-center gap-4">
            <button class="bg-red-500 rounded px-3 py-2 my-2">{{ __('Delete') }}</button>
        </div>

                    </form>
    </div>
</div>
</div>
@endforeach -->
</div>
    <div>
        <div>
            <div>Welcome To the help Page! How can we help?</div>
        </div>
        <form id="chatbot-form" action="event(new complaintNot(userinput))" method="post">
            @csrf
            <input type="text" id="userinput" name="userinput" placeholder="Enter your question...">
            <button type="submit">submit</button>
        </form>
    </div>
</x-app-layout>