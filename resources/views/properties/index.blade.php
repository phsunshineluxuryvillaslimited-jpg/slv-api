<?php 
// echo "<pre>";
// print_r($properties[0]->amenities); exit;
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Properties') }}
        </h2>
    </x-slot>

    <section class="pt-12">
        <div class="py-3 mx-auto max-w-10xl sm:px-6 lg:px-8">
            <div class="mb-5">
                <a href="{{ url('properties/create') }}" class="px-5 py-2 text-white bg-blue-400 rounded-md hover:bg-blue-500">
                    {{ __('+ Create New Property')  }}
                </a>
            </div>
            <div class="w-full p-5 bg-white border rounded mt b ">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase bg-gray-100 border-b-2 border-gray-200"
                        >
                            Thumbnail
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase bg-gray-100 border-b-2 border-gray-200"
                        >
                            Reference #
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase bg-gray-100 border-b-2 border-gray-200"
                        >
                            Title
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase bg-gray-100 border-b-2 border-gray-200"
                        >
                            Location
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase bg-gray-100 border-b-2 border-gray-200"
                        >
                            Bedroom
                        </th>
                        <th
                            width="10%" class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase bg-gray-100 border-b-2 border-gray-200"
                        >
                            Price (&euro;)
                        </th>
                        <th
                             class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase bg-gray-100 border-b-2 border-gray-200"
                        >
                            Plot Size
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase bg-gray-100 border-b-2 border-gray-200"
                        >
                            Area Size
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase bg-gray-100 border-b-2 border-gray-200"
                        >
                            Bank
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase bg-gray-100 border-b-2 border-gray-200"
                        >
                            Website Live
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase bg-gray-100 border-b-2 border-gray-200"
                        >
                            Action
                        </th>
                        <th
                            class="px-5 py-3 bg-gray-100 border-b-2 border-gray-200"
                        ></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $properties as $property )
                            <tr>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <img
                                        class="w-full h-full rounded size-40"
                                        src="{{ $property->photos[0]->url ?? 'https://via.placeholder.com/150' }}"
                                        alt=""
                                    />
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $property->reference }}</p>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $property->propertyType->name ?? '' }} in<br />{{ $property->address->town_city ?? '' }}</p>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200 uppercase">
                                    <span
                                    class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900"
                                    >
                                    <span
                                        aria-hidden
                                        class="absolute inset-0 bg-green-200 rounded-full opacity-50"
                                    ></span>
                                    <span class="relative">{{ $property->address->region ?? '' }}</span>
                                    </span>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200 text-center">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $property->bedrooms ?? 'N/A' }}</p>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200 text-center">
                                    <p class="text-gray-900 whitespace-no-wrap">&euro; {{ $property->price->basic_price ?? 0 }}</p>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200 text-center">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ number_format($property->plot, 0) ?? 'N/A' }}</p>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200 text-center">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ number_format($property->area_size, 0)?? 'N/A' }}</p>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200 text-center">
                                    <p class="text-gray-900 whitespace-no-wrap">BANK</p>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        @if ( $property->status === 'published' )
                                            <span class="px-2 py-1 text-xs text-green-800 bg-green-200 rounded-full">
                                                <a href="{{ config('app.WEBSITE_URL') }}/property/{{ str_replace(' ', '-', $property->propertyType->name) }}-in-{{ str_replace(' ', '-', $property->address->town_city) }}-ref{{ $property->reference }}" 
                                                    target="_blank">Live</a>
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs text-red-800 bg-red-200 rounded-full">Not Live</span>
                                        @endif
                                    </p>
                                </td>
                                <td class="px-5 py-5 text-sm text-right bg-white border-b border-gray-200">
                                    <a href="#" class="mr-4 text-blue-600 visited:text-purple-600 text-semi-bold"> Edit </a>
                                    <button
                                    type="button"
                                    class="inline-block text-gray-500 action-btn hover:text-gray-700"
                                    >
                                    <svg
                                        class="inline-block w-6 h-6 fill-current"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                        d="M12 6a2 2 0 110-4 2 2 0 010 4zm0 8a2 2 0 110-4 2 2 0 010 4zm-2 6a2 2 0 104 0 2 2 0 00-4 0z"
                                        />
                                    </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Render pagination navigation links -->
                <div class="mt-4">
                    {{ $properties->links() }}
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
@push('scripts')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/properties/index.css') }}">
    <script src="{{ asset('js/properties/index.js') }}" defer></script>
@endpush
