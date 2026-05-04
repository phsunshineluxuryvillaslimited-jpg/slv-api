<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Properties') }}
        </h3>
    </x-slot>

    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Add New Property') }}
            </h2>
        </div>
    </div>
    <livewire:multi-step-form />

    <br /><br /><br />
</x-app-layout>
