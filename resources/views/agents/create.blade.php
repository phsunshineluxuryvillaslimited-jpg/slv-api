<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Agents') }}
        </h2>
    </x-slot>
    <form action="{{ route('agent.store') }}" method="POST">
    @csrf
    <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
        <section>
            <h2 class="text-lg font-semibold">{{ __('Create Agent') }}</h2>
            <p>Ensure all required client information is accurate and securely saved.</p>
            <div class="py-5">
                <span class="required-field"></span> <span class="text-sm text-gray-800">{{ __('Required fields') }}</span>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-2 gap-5 mb-4 mt-3">
                <div>
                    <label for="firstName" class="required-field block text-black text-sm mb-1">{{ __('First Name') }}</label>
                    <input type="text" name="first_name" id="firstName" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required placeholder="Enter agent first name">
                    @error('first_name') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="lastName" class="required-field block text-black text-sm mb-1">{{ __('Last Name') }}</label>
                    <input type="text" name="last_name" id="lastName" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required placeholder="Enter agent last name">
                    @error('last_name') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="company" class="block text-black text-sm mb-1">{{ __('Primary Company') }}</label>
                    <input type="text" name="company" id="company" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required placeholder="Enter developer primary company">
                    @error('company') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
                 <div>
                    <label for="email" class="required-field block text-black text-sm mb-1">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required placeholder="Enter agent email address" >
                    @error('email') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="telephone" class="block text-black text-sm mb-1">{{ __('Telephone') }}</label>
                    <input type="text" name="phone_number" id="telephone" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter agent telephone number">
                </div>

                <div>
                    <label for="mobile" class="block text-black text-sm mb-1">{{ __('Mobile') }}</label>
                    <input type="text"  name="mobile_number" id="mobile" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter agent mobile number">
                </div>
            </div>
            <div class="py-5 flex gap-3">
                <a href="{{ route('agent.index') }}" class="bg-gray-500 text-white px-4 py-3 rounded hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded hover:bg-blue-600">
                    Submit
                </button>
                
            </div>
        </section>
    </div>
</x-app-layout>
