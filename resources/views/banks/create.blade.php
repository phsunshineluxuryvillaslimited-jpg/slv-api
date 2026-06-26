<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Agents') }}
        </h2>
    </x-slot>
    <form action="{{ route('bank.store') }}" method="POST">
    @csrf
        <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
            <section>
                <h2 class="text-lg font-semibold">{{ __('Add Bank') }}</h2>
                <p>Ensure all required client information is accurate and securely saved.</p>
                <div class="py-5">
                    <span class="required-field"></span> <span class="text-sm text-gray-800">{{ __('Required fields') }}</span>
                </div>
                <div class="mb-4 mt-3">
                    <div>
                        <label for="bankName" class="required-field block text-black text-sm mb-1">{{ __('Bank Name') }}</label>
                        <input type="text" name="name" id="bankName" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required placeholder="Enter bank name">
                        @error('name') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mb-4 mt-3">
                    <div>
                        <label for="address" class="required-field block text-black text-sm mb-1">{{ __('Address') }}</label>
                        <input type="text" name="address" id="address" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required placeholder="Enter bank address">
                        @error('address') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 gap-5 mb-4">
                    <div>
                        <label for="telephone" class="block text-black text-sm mb-1">{{ __('Telephone') }}</label>
                        <input type="text" name="phone_number" id="telephone" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter bank telephone number">
                    </div>

                    <div>
                        <label for="mobile" class="block text-black text-sm mb-1">{{ __('Mobile') }}</label>
                        <input type="text"  name="mobile_number" id="mobile" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter bank mobile number">
                    </div>
                </div>
                <div class="py-5 flex gap-3">
                    <a href="{{ route('bank.index') }}" class="bg-gray-500 text-white px-4 py-3 rounded hover:bg-gray-600">
                        Cancel
                    </a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded hover:bg-blue-600">
                        Submit
                    </button>
                    
                </div>
            </section>
        </div>
    </form>
</x-app-layout>
