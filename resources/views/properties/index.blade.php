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
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase bg-gray-100 border-b-2 border-gray-200"
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
                            Internal Area
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
                        <tr>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <img
                                    class="w-full h-full rounded size-40"
                                    src="https://images.unsplash.com/photo-1637734433731-621aca1c8cb6?ixlib"
                                    alt=""
                                />

                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">qwerty</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">Bungalow in Limassol</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <span
                                class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900"
                                >
                                <span
                                    aria-hidden
                                    class="absolute inset-0 bg-green-200 rounded-full opacity-50"
                                ></span>
                                <span class="relative">Limassol</span>
                                </span>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">3</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">&euro; 450,000</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">N/A</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">N/A</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">---</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">---</p>
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
                        <tr>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <img
                                    class="w-full h-full rounded size-40"
                                    src="https://images.unsplash.com/photo-1637734433731-621aca1c8cb6?ixlib"
                                    alt=""
                                />

                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">qwerty</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">Bungalow in Limassol</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <span
                                class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900"
                                >
                                <span
                                    aria-hidden
                                    class="absolute inset-0 bg-green-200 rounded-full opacity-50"
                                ></span>
                                <span class="relative">Limassol</span>
                                </span>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">3</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">&euro; 450,000</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">N/A</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">N/A</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">---</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">---</p>
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
                        <tr>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <img
                                    class="w-full h-full rounded size-40"
                                    src="https://images.unsplash.com/photo-1637734433731-621aca1c8cb6?ixlib"
                                    alt=""
                                />

                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">qwerty</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">Bungalow in Limassol</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <span
                                class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900"
                                >
                                <span
                                    aria-hidden
                                    class="absolute inset-0 bg-green-200 rounded-full opacity-50"
                                ></span>
                                <span class="relative">Limassol</span>
                                </span>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">3</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">&euro; 450,000</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">N/A</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">N/A</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">---</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">---</p>
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
                        <tr>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <img
                                    class="w-full h-full rounded size-40"
                                    src="https://images.unsplash.com/photo-1637734433731-621aca1c8cb6?ixlib"
                                    alt=""
                                />

                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">qwerty</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">Bungalow in Limassol</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <span
                                class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900"
                                >
                                <span
                                    aria-hidden
                                    class="absolute inset-0 bg-green-200 rounded-full opacity-50"
                                ></span>
                                <span class="relative">Limassol</span>
                                </span>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">3</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">&euro; 450,000</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">N/A</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">N/A</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">---</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">---</p>
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
                        <tr>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <img
                                    class="w-full h-full rounded size-40"
                                    src="https://images.unsplash.com/photo-1637734433731-621aca1c8cb6?ixlib"
                                    alt=""
                                />

                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">qwerty</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">Bungalow in Limassol</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <span
                                class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900"
                                >
                                <span
                                    aria-hidden
                                    class="absolute inset-0 bg-green-200 rounded-full opacity-50"
                                ></span>
                                <span class="relative">Limassol</span>
                                </span>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">3</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">&euro; 450,000</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">N/A</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">N/A</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">---</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">---</p>
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
                    </tbody>
                    </table>
            </div>
        </div>
    </section>
</x-app-layout>
@push('scripts')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/properties/index.css') }}">
    <script src="{{ asset('js/properties/index.js') }}" defer></script>
@endpush
