<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Country Coordinator Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">{{ __("Welcome, Country Coordinator!") }}</h3>
                    <p class="mt-2 text-gray-600">{{ __("This dashboard is tailored for managing activities in your assigned country.") }}</p>
                    @if(auth()->user()->country)
                        <p class="mt-2 font-semibold">{{ __("Assigned Country: ") }} {{ auth()->user()->country }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
