<?php
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Property;
use Illuminate\Validation\ValidationException;


new class extends Component
{
    use WithFileUploads;

    public bool $isEdit = false;

    public ?Property $property;

    public int $propertyId;
    #[Validate([
        'photos' => 'required|array|max:5', // Max 5 total files
        'photos.*' => 'image|max:1024|mimes:jpeg,jpg,webp' // Individual rules per image
    ])]
    public $photos = [];

    public $tempPhotos = [];

    public $propertyReference = [];

    // 2mb
    // jpeg webp

    // .doc .pdf .docx .xlsx .csv

    public function mount(Property $property, $isEdit = false): void
    {
        $this->property = $property;
        $this->isEdit   = $isEdit;
        $this->propertyId = $property->id;
        $this->propertyReference = $property->reference;

        if ($isEdit && ($property && $property->photos()->exists())) {
            $this->photos = $property->photos()->orderBy('sort_order')->get();
        }

        // load tempt Images which is not yet stored in database
        $this->getS3TempPhotos();
    }

    /**
     * Populate all temporary images that was not yet stored in database
     * Temporary file images store in AWS s3 bucket
     * Remove in stored list the existing images from database base on temp photos in AWS S3
     */
    public function getS3TempPhotos()
    {
        if ( $this->property->reference !== '' ) {

            $this->tempPhotos = Storage::disk('s3')->files($this->property->reference);
            if (!empty($this->tempPhotos)) {
                foreach ($this->photos as $photo) {
                    if ($key = array_search($photo->path, $this->tempPhotos)) {
                        unset($this->tempPhotos[$key]);
                    }
                }
            }
        }
    }

    // for creating action
    #[On('parentNextStepButtonTriggered')]
    public function hundleNextStepButtonTriggered()
    {
        try {

            foreach ($this->tempPhotos as $key => $item) {
                PropertyPhotos::create([
                    'property_id' => $this->propertyId,
                    'type' => 'gallery',
                    'path' => $item['path'],
                    'url' => $item['url'],
                    'orig_filename' => $item['orig_filename'],
                    'sort_order' => ++$key
                ]);
            }

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
            foreach ($this->tempPhotos as $key => $item) {
                // dd($item['orig_filename']);
                PropertyPhotos::updateOrCreate([
                    'orig_filename' => $item['orig_filename']
                ],[
                    'property_id' => $this->propertyId,
                    'type' => 'gallery',
                    'path' => $item['path'],
                    'url' => $item['url'],
                    'orig_filename' => $item['orig_filename'],
                    'sort_order' => ++$key
                ]);
            }

            session()->flash('success', 'Property updated successfully');
         } catch (ValidationException $e) {
            Log::info('Property validation error. Please double check.');
            throw $e;
        }
        
    }
}

?><div>
    <!-----------------------------------------
    Basic location info
    ----------------------------------------->
    <div class="flex max-w-7xl mt-3 mx-auto sm:px-6 lg:px-8">
        <div class="ml-auto text-blue-900 font-semibold font-custom pr-3">{{ $property->reference }}</div>
    </div>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Floor Plans')  }}
                    </h3>
                    <p class="mb-5 text-sm text-gray-600">{{ __('Upload floor plans of the property. This will help your property show up in more search results and attract more potential buyers.') }}</p>
                    <div class="border rounded">
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 bg-neutral-secondary-medium border border-dashed border-default-strong rounded-base cursor-pointer hover:bg-neutral-tertiary-medium">
                                <div class="flex flex-col items-center justify-center text-body pt-2 pb-2">
                                    <svg class="w-8 h-8 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2"/></svg>
                                    <p class="mb-2 text-sm"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-center">Accepted formats: JPG & WEBP <br >(Max 30MB per file)</p>
                                </div>
                                <input id="dropzone-file" type="file" class="hidden" />
                            </label>
                        </div> 
                    </div>
                </div>  
            </div>
        </div>
    </div>
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

@script
<script>
    let imageType = 'galleries';

    window.isUploading = function() {
        return this.files.some(file => file.progress < 100);
    }

    window.uploadMultiple = function (folder) {
    return {
        imageType: 'galleries',
        files: [],
        galleries: [], 

        async upload(event) {
            showLoading = true;

            let uploads = [];

            for (let file of event.target.files) {
                uploads.push(this.uploadSingle(file, folder));
            }

            await Promise.all(uploads);

            @this.set('tempPhotos', this[this.imageType]);
        },

        uploadSingle(file, folder) {
            return new Promise((resolve, reject) => {

                let fileProgress = { 
                    id: Date.now() + Math.random(),
                    progress: 0
                };

                let formData = new FormData();
                formData.append('file', file);
                formData.append('folder', folder);

                const xhr = new XMLHttpRequest();

                xhr.open('POST', '/s3/file-upload', true);
                xhr.setRequestHeader(
                    'X-CSRF-TOKEN',
                    document.querySelector('meta[name="csrf-token"]').content
                );

                xhr.upload.onprogress = (e) => {
                    if (e.lengthComputable) {
                        fileProgress.progress = Math.round((e.loaded / e.total) * 100);
                    }
                };

                xhr.onload = () => {
                    if (xhr.status === 200) {
                        const res = JSON.parse(xhr.responseText);

                        this.files.push({
                            orig_filename: res.orig_filename,
                            path: res.path,
                            url: res.url,
                            progress: fileProgress
                        });

                        this[this.imageType].push({
                            orig_filename: res.orig_filename,
                            path: res.path,
                            url: res.url
                        });

                        resolve();
                    } else {
                        reject();
                    }
                };

                xhr.onerror = reject;

                xhr.send(formData);
            });
        }
    }
}
</script>
@endscript