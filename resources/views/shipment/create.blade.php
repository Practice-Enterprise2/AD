<x-app-layout>
    <div class="w-screen flex flex-col items-center justify-center text-gray-900 dark:text-gray-100">
        <h2 class="text-lg font-medium py-5 text-gray-900 dark:text-gray-100">
            {{ __('Add Shipment') }}
            
            
        </h2>
        <form method="post" action="{{ route('shipment.store') }}" class="mt-6 space-y-6 w-10/12 text-gray-900">
        @csrf
        <div class="w-12/12 flex flex-row justify-start">
        <div class="w-6/12 flex flex-col justify-start items-center gap-4"> 
            <div class="w-1/2">
            <x-input-label for="from_name" :value="__('From:')" />
            <input id="from_name" name="from_name" type="text" class="mt-1 block w-full" value="{{Auth::user()->name}}"/>
            <x-input-error class="mt-2" :messages="$errors->get('from_name')" />
            </div>
            <div class="w-1/2">
            <x-input-label for="from_phone" :value="__('Sender Phone')" />
            <input id="from_phone" name="from_phone" type="text" class="mt-1 block w-full" value="{{Auth::user()->phone}}"/>
            <x-input-error class="mt-2" :messages="$errors->get('from_phone')" />
            </div>
            <div class="w-1/2">
            <x-input-label for="from_address" :value="__('Sender Address')" />
            <input id="from_address" name="from_address" type="text" class="mt-1 block w-full" value="{{Auth::user()->address}}"/>
            <x-input-error class="mt-2" :messages="$errors->get('from_address')" />
            </div>
            <div class="w-1/2">
            <x-input-label for="from_postalcode" :value="__('Sender PostalCode')" />
            <input id="from_postalcode" name="from_postalcode" type="text" class="mt-1 block w-full" value="{{Auth::user()->postalcode}}"/>
            <x-input-error class="mt-2" :messages="$errors->get('from_postalcode')" />
            </div>
            <div class="w-1/2">
            <x-input-label for="from_city" :value="__('Sender City')" />
            <input id="from_city" name="from_city" type="text" class="mt-1 block w-full" value="{{Auth::user()->city}}"/>
            <x-input-error class="mt-2" :messages="$errors->get('from_city')" />
            </div>
            <div class="w-1/2">
            <x-input-label for="from_country" :value="__('Sender Country')" />
            <input id="from_country" name="from_country" type="text" class="mt-1 block w-full" value="{{Auth::user()->country}}"/>
            <x-input-error class="mt-2" :messages="$errors->get('from_country')" />
            </div>
            <div class="w-1/2">
            <x-input-label for="weight" :value="__('Total Weight')" />
            <input id="weight" name="weight" type="text" class="mt-1 block w-full"/>
            <x-input-error class="mt-2" :messages="$errors->get('weight')" />
            </div>
            <div class="w-1/2">
            <x-input-label for="package_num" :value="__('Number of Packages')" />
            <input id="package_num" name="package_num" type="text" class="mt-1 block w-full"/>
            <x-input-error class="mt-2" :messages="$errors->get('package_num')" />
            </div>
        </div>
        <div class="w-6/12 flex flex-col justify-start items-center gap-4">
            <div class="w-1/2">
            <x-input-label for="to_name" :value="__('Recipient Name')" />
            <input id="to_name" name="to_name" type="text" class="mt-1 block w-full"/>
            <x-input-error class="mt-2" :messages="$errors->get('to_name')" />
            </div>
            <div class="w-1/2">
            <x-input-label for="to_phone" :value="__('Recipient Phone')" />
            <input id="to_phone" name="to_phone" type="text" class="mt-1 block w-full"/>
            <x-input-error class="mt-2" :messages="$errors->get('to_phone')" />
            </div>
            <div class="w-1/2">
            <x-input-label for="to_address" :value="__('Recipient Address')" />
            <input id="to_address" name="to_address" type="text" class="mt-1 block w-full"/>
            <x-input-error class="mt-2" :messages="$errors->get('to_address')" />
            </div>
            <div class="w-1/2">
            <x-input-label for="to_postalcode" :value="__('Recipient PostalCode')" />
            <input id="to_postalcode" name="to_postalcode" type="text" class="mt-1 block w-full"/>
            <x-input-error class="mt-2" :messages="$errors->get('to_postalcode')" />
            </div>
            <div class="w-1/2">
            <x-input-label for="to_city" :value="__('Recipient City')" />
            <input id="to_city" name="to_city" type="text" class="mt-1 block w-full"/>
            <x-input-error class="mt-2" :messages="$errors->get('to_city')" />
            </div>
            <div class="w-1/2">
            <x-input-label for="to_country" :value="__('Recipient Country')" />
            <input id="to_country" name="to_country" type="text" class="mt-1 block w-full"/>
            <x-input-error class="mt-2" :messages="$errors->get('to_country')" />
            </div>
            <div class="flex items-center gap-4 my-10">
            <x-primary-button>{{ __('Create Shipment') }}</x-primary-button>
            </div>
            </div>
        </form>
        </div>
    </div>
</x-app-layout>