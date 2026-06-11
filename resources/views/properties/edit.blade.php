<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Properties') }}
        </h3>
    </x-slot>

    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
               <span class="font-custom font-bold text-yellow-500/100 text-shadow-lg/30">{{ __('Edit') }}</span> <span class="font-custom font-thin text-gray-800">{{ __('Property') }}</span>
            </h2>
        </div>
    </div>
    
    <livewire:multi-step-form :editProperty="$property" :editMode="$editMode"/>

    <br /><br /><br />
</x-app-layout>
