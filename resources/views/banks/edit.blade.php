<section>
    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
        <div>
            <label for="bank_name" class="required-field block text-black text-sm mb-1">{{ __('Bank Name') }}</label>
            <input type="text" wire:model.live.debounce.500ms="bank_name" id="bank_name" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            @error('bank_name') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror        
        </div>
        <div>
            <label for="branch" class="required-field block text-black text-sm mb-1">{{ __('Bank Branch') }}</label>
            <input type="text" wire:model.live.debounce.500ms="branch" id="branch" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            @error('branch') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="account_ref" class="required-field block text-black text-sm mb-1">{{ __('Account Reference') }}</label>
            <input type="text" wire:model.live.debounce.500ms="account_ref" id="account_ref" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            @error('account_ref') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-2 gap-5 mb-4">
        <div>
            <label for="account_name" class="required-field block text-black text-sm mb-1">{{ __('Account Name') }}</label>
            <input type="text" wire:model.live.debounce.500ms="account_name" id="account_name" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            @error('account_name') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="account_number" class="required-field block text-black text-sm mb-1">{{ __('Accunt Number') }}</label>
            <input type="text" wire:model.live.debounce.500ms="account_number" id="account_number" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            @error('account_number') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="mb-4">
        <div>
            <label for="address" class="required-field block text-black text-sm mb-1">{{ __('Address') }}</label>
            <input type="text" wire:model.live.debounce.500ms="address" id="address" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            @error('address') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
        </div>
    </div>
</section>
