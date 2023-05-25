<x-app-layout>
    <div class="border-2 border-black rounded-lg mx-auto w-3/5 mt-40 bg-gray-600 p-4">
        <h1 class="text-5xl font-bold text-center">Response:</h1>
        <div class="mt-12 text-3xl text-center">
            {{ $errorMessage }}
        </div>
        <div class="w-fit mx-auto">
            <a href="{{ route('shipments.showshipments')}}"><button
                class="mt-3 px-12 py-2 rounded-md border-2 border-blue-600 bg-blue-400 text-black font-bold hover:bg-blue-500"
                id="cancelButton">Go Back</button></a>

        </div>
    </div>
</x-app-layout>