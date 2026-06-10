<?php
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Property;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

new class extends Component
{
    use WithFileUploads;

    public string $photo;

    // public ?UploadedFile $image = null;

    public bool $isEdit = false;

    public ?Property $property;

    public int $propertyId;

    public $gallery = [];

    public function mount(Property $property, $isEdit = false): void
    {
        $this->property = $property;
        $this->isEdit   = $isEdit;
        $this->propertyId = $property->id;
    }

    // for creating action
    #[On('parentNextStepButtonTriggered')]
    public function hundleNextStepButtonTriggered()
    {
        try {
            $validatedData = $this->validate();
            $this->property->photos()->updateOrCreate([
                    'property_id' => $this->property->id,
                ],
                $validatedData
            );

            $this->dispatch( 'proceed-to-next-step', property_id: $this->property->id);
         } catch (ValidationException $e) {
            Log::info('Property validation error. Please double check.');
            throw $e;
        }
    }

    // for edit action
    #[On('parentUpdateButtonTriggered')]
    public function handleUpdateProperty()
    {   
        try {
            $validatedData = $this->validate();

            $this->property->photos()->updateOrCreate([
                    'property_id' => $this->property->id,
                ],
                $validatedData
            );

            session()->flash('success', 'Property updated successfully');
         } catch (ValidationException $e) {
            Log::info('Property validation error. Please double check.');
            throw $e;
        }
        
    }
    
}

?>

<div x-data="uploadMultiple('gallery')">
    <label>Photos</label>

    <input type="file" multiple @change="upload($event)">

    <div class="flex gap-2 mt-2">
        <template x-for="file in files">
            <img :src="file.url" width="100">
        </template>
    </div>
</div>
@script
<script>
function uploadSingle(folder) {
    return {
        fileUrl: null,

        async upload(event) {
            const file = event.target.files[0];

            const res = await fetch('/s3/file-upload/', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    filename: file.name,
                    type: file.type,
                    folder: folder
                })
            });

            const data = await res.json();

            await fetch(data.url, {
                method: 'PUT',
                headers: { 'Content-Type': file.type },
                body: file
    use WithFileUploads;

    public string $photo;

    // public ?UploadedFile $image = null;

    public bool $isEdit = false;

    public ?Property $property;

    public int $propertyId;

    public $gallery = [];

    public function mount(Property $property, $isEdit = false): void
    {
        $this->property = $property;
        $this->isEdit   = $isEdit;
        $this->propertyId = $property->id;
    }

    // for creating action
    #[On('parentNextStepButtonTriggered')]
    public function hundleNextStepButtonTriggered()
    {
        try {
            $validatedData = $this->validate();
            $this->property->photos()->updateOrCreate([
                    'property_id' => $this->property->id,
                ],
                $validatedData
            );

            $this->dispatch( 'proceed-to-next-step', property_id: $this->property->id);
         } catch (ValidationException $e) {
            Log::info('Property validation error. Please double check.');
            throw $e;
        }
    }

    // for edit action
    #[On('parentUpdateButtonTriggered')]
    public function handleUpdateProperty()
    {   
        try {
            $validatedData = $this->validate();

            $this->property->photos()->updateOrCreate([
                    'property_id' => $this->property->id,
                ],
                $validatedData
            );

            session()->flash('success', 'Property updated successfully');
         } catch (ValidationException $e) {
            Log::info('Property validation error. Please double check.');
            throw $e;
        }
        
    }
            });

            this.fileUrl = data.file_url;

            // @this.set(folder, {
            //     path: data.path,
            //     url: data.file_url
            // });
        }
    }
}


function uploadMultiple(folder) {
    return {
        files: [],

        async upload(event) {
            for (let file of event.target.files) {

                const res = await fetch('/s3/file-upload/', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        filename: file.name,
                        type: file.type,
                        folder: folder
                    })
                });

                const data = await res.json();

                await fetch(data.url, {
                    method: 'PUT',
                    headers: { 'Content-Type': file.type },
                    body: file
                });

                this.files.push({
                    path: data.path,
                    url: data.file_url
                });

                window.Livewire.find('{{ $propertyId }}').push(folder, {
                    path: data.path,
                    url: data.file_url
                });
            }
        }
    }
}
</script>
@endscript
    <!-----------------------------------------
    Basic location info
    ----------------------------------------->
   
   <?php /* <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Photos')  }}
                    </h3>
                    <p class="mb-5 text-sm text-gray-600">{{ __('Upload photos of the property. This will help your property show up in more search results and attract more potential buyers.') }}</p>
                    <div class="border rounded">
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 bg-neutral-secondary-medium border border-dashed border-default-strong rounded-base cursor-pointer hover:bg-neutral-tertiary-medium">
                                <div class="flex flex-col items-center justify-center text-body pt-2 pb-2">
                                    <svg class="w-8 h-8 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2"/></svg>
                                    <p class="mb-2 text-sm"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-center">Accepted formats: JPG & WEBP <br >(Max 30MB per file)</p>
                                </div>
                                <input wire:model="photos" id="dropzone-file" type="file" class="hidden"/>
                            </label>
                        </div> 
                    </div>
                </div>  
            </div>
        </div>
    </div>
    @if ($photos)
        <img src="{{ $photos->temporaryUrl() }}" width="100">
    @endif
    @if ($errors->any())
        <div x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
            aria-modal="true" 
            role="dialog">

            <!-- Modal Box -->
            <div class="bg-white rounded-lg shadow-xl p-6 max-w-sm w-full mx-4 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="12" r="9" stroke-width="2"></circle>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9l6 6M15 9l-6 6" />
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">{{ __("Oops! Some fields need your attention.") }} </h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500"></p>
                </div>
            </div>
        </div>
    @endif
    @if (session()->has('success'))
        <div x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
            aria-modal="true" 
            role="dialog">

            <!-- Modal Box -->
            <div class="bg-white rounded-lg shadow-xl p-6 max-w-sm w-full mx-4 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 8" />
                    </svg>
                </div>
                
                <h3 class="text-lg leading-6 font-medium text-gray-900">{{ session('success') }}</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500"></p>
                </div>
            </div>
        </div>
    @endif
    </div>
*/?>
