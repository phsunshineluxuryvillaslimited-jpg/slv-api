<?php
use Livewire\Component;
 
new class extends Component 
{
    public int $step;
 
    public function mount($step = null)
    {
        $this->step = $step;
    }
}

?>
    <div class="text-xs flex py-3 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="step">
            <div class="flex py-3">
                <div class="ring-2 ring-[#01ADF1] rounded-full p-[11px]">
                    <div class="h-2.5 w-2.5 rounded-full bg-[#01ADF1] ring-0"></div>
                </div>
                <div class="w-20 flex items-center">
                    <hr class="border-t-2 border-[#01ADF1] w-full">
                </div>
            </div>
            <div class="block text-[#01ADF1]">1 Reference {{ $step }}</div>
        </div>
        <div>
            <div class="flex py-3">
                <div class="ring-2 ring-gray-400 rounded-full p-[11px]">
                    <div class="h-2.5 w-2.5 rounded-full bg-gray-300 ring-0"></div>
                </div>
                <div class="w-20 flex items-center pl-[2px]">
                    <hr class="border-t-2 border-gray-300 w-full">
                </div>
            </div>
            <div class="block">2 Location</div>
        </div>
         <div>
            <div class="flex py-3">
                <div class="ring-2 ring-gray-400 rounded-full p-[11px]">
                    <div class="h-2.5 w-2.5 rounded-full bg-gray-300 ring-0"></div>
                </div>
                <div class="w-20 flex items-center pl-[2px]">
                    <hr class="border-t-2 border-gray-300 w-full">
                </div>
            </div>
            <div class="block flex-nowrap">3 Photos</div>
        </div>
         <div>
            <div class="flex py-3">
                <div class="ring-2 ring-gray-400 rounded-full p-[11px]">
                    <div class="h-2.5 w-2.5 rounded-full bg-gray-300 ring-0"></div>
                </div>
                <div class="w-20 flex items-center pl-[2px]">
                    <hr class="border-t-2 border-gray-300 w-full">
                </div>
            </div>
            <div class="block flex-nowrap">4 Floor Plan</div>
        </div>
         <div>
            <div class="flex py-3">
                <div class="ring-2 ring-gray-400 rounded-full p-[11px]">
                    <div class="h-2.5 w-2.5 rounded-full bg-gray-300 ring-0"></div>
                </div>
                <div class="w-20 flex items-center pl-[2px]">
                    <hr class="border-t-2 border-gray-300 w-full">
                </div>
            </div>
            <div class="block flex-nowrap">5 Amenities</div>
        </div>
         <div>
            <div class="flex py-3">
                <div class="ring-2 ring-gray-400 rounded-full p-[11px]">
                    <div class="h-2.5 w-2.5 rounded-full bg-gray-300 ring-0"></div>
                </div>
                <div class="w-20 flex items-center pl-[2px]">
                    <hr class="border-t-2 border-gray-300 w-full">
                </div>
            </div>
            <div class="block flex-nowrap">6 Options</div>
        </div>
         <div>
            <div class="flex py-3">
                <div class="ring-2 ring-gray-400 rounded-full p-[11px]">
                    <div class="h-2.5 w-2.5 rounded-full bg-gray-300 ring-0"></div>
                </div>
                <div class="w-20 flex items-center pl-[2px]">
                    <hr class="border-t-2 border-gray-300 w-full">
                </div>
            </div>
            <div class="block flex-nowrap">7 Vendor</div>
        </div>
         <div>
            <div class="flex py-3">
                <div class="ring-2 ring-gray-400 rounded-full p-[11px]">
                    <div class="h-2.5 w-2.5 rounded-full bg-gray-300 ring-0"></div>
                </div>
                <div class="w-20 flex items-center pl-[2px]">
                    <hr class="border-t-2 border-gray-300 w-full">
                </div>
            </div>
            <div class="block flex-nowrap">8 Custom Fields</div>
        </div>
         <div>
            <div class="flex py-3">
                <div class="ring-2 ring-gray-400 rounded-full p-[11px]">
                    <div class="h-2.5 w-2.5 rounded-full bg-gray-300 ring-00"></div>
                </div>
                <div class="w-20 flex items-center pl-[2px]">
                    <hr class="border-t-2 border-gray-300 w-full">
                </div>
            </div>
            <div class="block flex-nowrap">9 V-tour Video</div>
        </div>
         <div>
            <div class="flex py-3">
                <div class="ring-2 ring-gray-400 rounded-full p-[11px]">
                    <div class="h-2.5 w-2.5 rounded-full bg-gray-300 ring-0"></div>
                </div>
            </div>
            <div class="block flex-nowrap">10 Title & Description</div>
        </div>
    </div>