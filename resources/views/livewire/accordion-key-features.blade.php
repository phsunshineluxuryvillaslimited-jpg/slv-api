<div class="space-y-2">

    @foreach($items as $item)
        <div wire:ignore.self class="border rounded">

            <button
                wire:click="toggle({{ $item['id'] }})"
                class="flex w-full px-4 py-3 text-left bg-gray-100 hover:bg-gray-200"
            >
                <span>{{ $item['title'] }}</span>

                <svg
                    class="w-5 h-5 transition-transform duration-300 ml-auto 
                        {{ $openItem === $item['id'] ? 'rotate-180' : '' }}"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7"
                    />
                </svg>

            </button>

            @if($openItem === $item['id'])
                <div wire:ignore class="p-4 bg-white border-t">
                    <div class="grid grid-cols-3 gap-4">
                        <!-- <div class=""> -->
                            @if (isset($item['fields']) && count($item['fields']) > 0)
                            @foreach ($item['fields'] as $field)
                            <div wire:ignore.self class="border border-gray-300 flex items-center rounded p-2">
                                <span>{{ $field['label'] }}</span>
                                <input type="checkbox" class="ml-auto rounded border-gray-400" />
                            </div>
                            @endforeach
                            @endif
                        <!-- </div> -->
                    </div>
                    
                </div>
            @endif

        </div>
    @endforeach
</div>