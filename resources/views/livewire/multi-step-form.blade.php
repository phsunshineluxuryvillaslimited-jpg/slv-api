<section>
    
    <!-- Step 1 -->
    @if ( $currentStep == 1 )
        <livewire:dotted-steps :step="$currentStep" :isEdit="$isEdit" />
        <livewire:property.step-1-reference-form :property="$property" />
    @endif

     <!-- Step 2 -->
    @if ( $currentStep == 2 )
        <livewire:dotted-steps :step="$currentStep" :isEdit="$isEdit" />
        <livewire:property.step-2-location-form :property="$property" :isEdit="$isEdit" />
    @endif

     <!-- Step 3 -->
    @if ( $currentStep == 3 )
        <livewire:dotted-steps :step="$currentStep" :isEdit="$isEdit" />
        <livewire:property.step-3-photos-form :property="$property" :isEdit="$isEdit" />
    @endif

     <!-- Step 4 -->
    @if ( $currentStep == 4 )
        <livewire:dotted-steps :step="$currentStep" :isEdit="$isEdit" />
        <livewire:property.step-4-floor-plan-form :property="$property" :isEdit="$isEdit"/>
    @endif

     <!-- Step 5 -->
    @if ( $currentStep == 5 )
        <livewire:dotted-steps :step="$currentStep" :isEdit="$isEdit" />
        <livewire:property.step-5-amenities-form :property="$property" :isEdit="$isEdit" />
    @endif

     <!-- Step 6 -->
    @if ( $currentStep == 6 )
        <livewire:dotted-steps :step="$currentStep" :isEdit="$isEdit" />
        <livewire:property.step-6-channel-manager-form :property="$property" :isEdit="$isEdit" />
    @endif 

     <!-- Step 7 -->
    
    @if ( $currentStep == 7 )
        <livewire:dotted-steps :step="$currentStep" :isEdit="$isEdit" />
        <livewire:property.step-7-vendor-details-form :property="$property" :isEdit="$isEdit" />
    @endif

     <!-- Step 8 -->
    @if ( $currentStep == 8 )
        <livewire:dotted-steps :step="$currentStep" :isEdit="$isEdit" />
        <livewire:property.step-8-key-features-form :property="$property" :isEdit="$isEdit" />
    @endif

     <!-- Step 9 -->
    @if ( $currentStep == 9 )
        <livewire:dotted-steps :step="$currentStep" :isEdit="$isEdit" />
        <livewire:property.step-9-videos-virtual-tour-form :property="$property" :isEdit="$isEdit" />
    @endif

     <!-- Step 10 -->
    @if ( $currentStep == 10 )
        <livewire:dotted-steps :step="$currentStep" :isEdit="$isEdit" />
        <livewire:property.step-10-title-description-form :property="$property" :isEdit="$isEdit" />
    @endif

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 flex justify-end">
            <div>
                
                @if ( !$isEdit )   
                    @if ( $currentStep > 1 )
                        <button wire:click="previousStep" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded mr-1">&larr; Back</button>
                    @endif

                    @if ( $currentStep != 10 )
                        <button id="nextBtn"  wire:click="$dispatch('parentNextStepButtonTriggered')" wire:loading.class="opacity-50" class="px-7 py-2 bg-orange-400 text-white rounded-md hover:bg-orange-500">
                            <span wire:loading.remove>{{ __('Save and Next') }} &rarr;</span>
                            <span wire:loading>
                                Loading..
                            </span>
                        </button>
                        <!-- <button id="nextBtn"  wire:click="nextStep" wire:loading.class="opacity-50" class="px-7 py-2 bg-orange-400 text-white rounded-md hover:bg-orange-500">
                            <span wire:loading.remove>{{ __('Save and Next') }} &rarr;</span>
                            <span wire:loading>
                                Loading..
                            </span>
                        </button> -->
                    @else
                        <!-- <button wire:click="nextStep" wire:loading.class="opacity-50" class="px-7 py-2 bg-orange-400 text-white rounded-md hover:bg-orange-500">
                            <span wire:loading.remove>{{ __('Save and Publish') }} &rarr;</span>
                            <span wire:loading>
                                Loading..
                            </span>
                        </button> -->
                    @endif
                @else
                <!---------BACK BUTTON----------->
                    <a href="{{ route('properties.index') }}" class="px-4 py-3 bg-gray-200 hover:bg-gray-300 rounded mr-1 min-w-[130px]">
                        &larr; Cancel
                    </a>
                <!---------EDIT BUTTON----------->
                    <button id="nextBtn"  wire:click="$dispatch('parentUpdateButtonTriggered')" wire:loading.class="opacity-50" 
                        class="px-7 py-2 bg-red-500 text-white rounded-md hover:bg-red-500 cursor-pointer"
                    >
                        <span wire:loading.remove>&#x21bb; {{ __('Update') }} </span>
                        <span wire:loading>
                            Loading..
                        </span>
                    </button>
                @endif
            </div>
        </div>
    </div>
</section>
@script
    <script>
    // let mapInitialized = false;

    Livewire.on('load-map', () => {
        // if (!mapInitialized) {
            // if (document.getElementById('map')) {
                initMap();
            // }
            // mapInitialized = true;
        // }
    });

    Livewire.on('load-tinymce', () => {
        tinymce.init({
            selector: '#description'
        });
    });
<?php /*
    // function uploadSingle(folder) {
    //     return {
    //         fileUrl: null,

    //         async upload(event) {
    //             const file = event.target.files[0];

    //             const res = await fetch('/s3/file-upload/', {
    //                 method: 'POST',
    //                 headers: {
    //                     'Content-Type': 'application/json',
    //                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //                 },
    //                 body: JSON.stringify({
    //                     filename: file.name,
    //                     type: file.type,
    //                     folder: folder
    //                 })
    //             });

    //             const data = await res.json();

    //             await fetch(data.url, {
    //                 method: 'PUT',
    //                 headers: { 'Content-Type': file.type },
    //                 body: file
    //             });

    //             this.fileUrl = data.file_url;

    //             @this.set(folder, {
    //                 path: data.path,
    //                 url: data.file_url
    //             });
    //         }
    //     };
    // }

    // function uploadMultiple(folder) {
    //     return {
    //         files: [],

    //         async upload(event) {
    //             for (let file of event.target.files) {
    //                 console.log('upload');
    //                 const res = await fetch('/s3/file-upload/', {
    //                     method: 'POST',
    //                     headers: {
    //                         'Content-Type': 'application/json',
    //                         'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //                     },
    //                     body: JSON.stringify({
    //                         filename: file.name,
    //                         type: file.type,
    //                         folder: folder
    //                     })
    //                 });

    //                 const data = await res.json();

    //                 await fetch(data.url, {
    //                     method: 'PUT',
    //                     headers: { 'Content-Type': file.type },
    //                     body: file
    //                 });

    //                 this.files.push({
    //                     path: data.path,
    //                     url: data.file_url
    //                 });

    //                 window.Livewire.find('{{ $property->id }}').push(folder, {
    //                     path: data.path,
    //                     url: data.file_url
    //                 });
    //             }
    //         }
    //     }
    // }
*/ ?>
    </script>
@endscript
@push('scripts')
    @vite(['resources/js/Sortable.min.js'])
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjtQlPL0rirZ70g8Xew5Ol3mqhqmAju08&&callback=initMap&loading=async&libraries=places"></script>
    <script src="{{ asset('/js/google.map.js') }}" defer></script>
@endpush