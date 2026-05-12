<section>
    <!-- Step 1 -->
    @if ( $currentStep == 1 )
        <livewire:dotted-steps :step="$currentStep" />
        <livewire:property.reference-form />
    @endif

     <!-- Step 2 -->
    @if ( $currentStep == 2 )
        <livewire:dotted-steps :step="$currentStep" />
        
        @push('scripts')
            <script async defer>
                document.addEventListener('DOMContentLoaded', () => {
                    console.log('The DOM is fully loaded and parsed');
                    // Your code here
                });
                document.getElementById('nextBtn').addEventListener('click', () => {
                    console.log(document.getElementById('gmap'));
                    document.addEventListener('DOMContentLoaded', () => {
                    console.log('The DOM is fully loaded and parsed');
                    // Your code here
                });
                })
            </script>
        @endpush
        <livewire:property.location-form />
    @endif

     <!-- Step 3 -->
    @if ( $currentStep == 3 )
        <livewire:dotted-steps :step="$currentStep" />
        <livewire:property.photos-form />
    @endif

     <!-- Step 4 -->
    @if ( $currentStep == 4 )
        <livewire:dotted-steps :step="$currentStep" />
        <livewire:property.floor-plan-form />
    @endif

     <!-- Step 5 -->
    @if ( $currentStep == 5 )
        <livewire:dotted-steps :step="$currentStep" />
        <livewire:property.distances-form />
    @endif

     <!-- Step 6 -->
    @if ( $currentStep == 6 )
        <livewire:dotted-steps :step="$currentStep" />
        <livewire:property.channel-manager-form  />
    @endif 

     <!-- Step 7 -->
    
    @if ( $currentStep == 7 )
        <livewire:dotted-steps :step="$currentStep" />
        <livewire:property.contact-details-form />
    @endif

     <!-- Step 8 -->
    @if ( $currentStep == 8 )
        <livewire:dotted-steps :step="$currentStep" />
        <livewire:property.key-features-form />
    @endif

     <!-- Step 9 -->
    @if ( $currentStep == 9 )
        <livewire:dotted-steps :step="$currentStep" />
        <livewire:property.videos-virtual-tour-form />
    @endif

     <!-- Step 10 -->
    @if ( $currentStep == 10 )
        <livewire:dotted-steps :step="$currentStep" />
        <livewire:property.title-description-form />
    @endif

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 flex justify-end">
            <div>
                @if ( $currentStep > 1 )
                    <button wire:click="previousStep" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded mr-1">Back</button>
                    <button wire:click="saveAsDraft" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded mr-1">Save as Draft</button>
                @endif

                @if ( $currentStep != 10 )
                    <button id="nextBtn"  wire:click="nextStep" wire:loading.class="opacity-50" class="px-7 py-2 bg-orange-400 text-white rounded-md hover:bg-orange-500">
                        <span wire:loading.remove>{{ __('Save and Next') }} &rarr;</span>
                        <span wire:loading>
                            Loading..
                        </span>
                    </button>
                @else
                    <!-- <button wire:click="nextStep" wire:loading.class="opacity-50" class="px-7 py-2 bg-orange-400 text-white rounded-md hover:bg-orange-500">
                        <span wire:loading.remove>{{ __('Save and Publish') }} &rarr;</span>
                        <span wire:loading>
                            Loading..
                        </span>
                    </button> -->
                @endif
            </div>
        </div>
    </div>
</section>
@push('scripts')
     <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjtQlPL0rirZ70g8Xew5Ol3mqhqmAju08&callback=initMap&loading=async" async defer
    ></script>
    <script src="{{ asset('/js/google.map.js') }}" defer></script>
@endpush