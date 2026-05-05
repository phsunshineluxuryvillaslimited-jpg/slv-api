<div class="text-xs flex py-3 max-w-7xl mx-auto sm:px-6 lg:px-8">
    @foreach ($step_names as $index => $name)
    <div class="step">
        <div class="flex py-3">
            <div class="relative ring-2 {{ ( $index <= $step ) ? 'ring-[#01ADF1]' : 'ring-gray-400' }} rounded-full p-[11px] {{ ($index < $step) ? 'bg-[#01ADF1]' : ''}}  ">
                <div class="h-2.5 w-2.5 rounded-full {{ ( $index <= $step ) ? 'bg-[#01ADF1]' : 'bg-gray-300' }} ring-0">
                </div>
                @if ( $index < $step  )
                <span class="absolute mx-auto text-white text-2xl top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">&#x1F5F8;</span>
                @endif
            </div>
            
            @if ( $index != 10 )
            <div class="w-20 flex items-center ml-0.5">
                <hr class="border-t-2 {{ ( $index < $step ) ? 'border-[#01ADF1]' : 'border-gray-300' }} w-full">
            </div>
            @endif
        </div>
        <div class="block {{ ( $index <= $step ) ? 'text-[#01ADF1]' : '' }}">{{ $index }} {{ $name }}</div>
    </div>
    @endforeach
</div>