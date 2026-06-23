<section>
    <div class="grid grid-cols-2 md:grid-cols-2 gap-5 mb-4 mt-3">
        <div>
            <label for="firstName" class="required-field block text-black text-sm mb-1">{{ __('First Name') }}</label>
            <input type="text" wire:model.live.debounce.500ms="first_name" id="firstName" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            @error('first_name') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="lastName" class="required-field block text-black text-sm mb-1">{{ __('Last Name') }}</label>
            <input type="text" wire:model.live.debounce.500ms="last_name" id="lastName" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            @error('last_name') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
        <div>
            <label for="telephone" class="required-field block text-black text-sm mb-1">{{ __('Telephone') }}</label>
            <input type="text" wire:model.live.debounce.500ms="phone_number" id="telephone" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            @error('phone_number') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="mobile" class="required-field block text-black text-sm mb-1">{{ __('Mobile') }}</label>
            <input type="text"  wire:model.live.debounce.500ms="mobile_number" id="mobile" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            @error('mobile_number') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="email" class="required-field block text-black text-sm mb-1">{{ __('Email') }}</label>
            <input type="email" wire:model.live.debounce.500ms="email" id="email" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            @error('email') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
        </div>
    </div>
</section>