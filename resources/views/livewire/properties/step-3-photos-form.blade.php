<?php
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Property;
use App\Models\PropertyFile;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

new class extends Component
{
    use WithFileUploads;

    public bool $isEdit = false;

    public ?Property $property;

    public int $propertyId;
    #[Validate([
        'photos' => 'required|array|max:5', // Max 5 total files
        'photos.*' => 'image|max:1024|mimes:jpeg,png', // Individual rules per image
    ])]
    public $photos = [];

    public $tempPhotos = [];

    public $propertyReference = [];

    public string $imageUrl;

    public $isListFresh = 'false';

    public ?UploadedFile $file = null;

    public $fileInputId = 1;

    /**
     * For delete action
     */
    public ?bool $showModal = false;
    public ?PropertyFile $selectDeletePhoto;
    

    // 2mb
    // jpeg webp

    // .doc .pdf .docx .xlsx .csv

    /**
     * Summary of mount. This will initialize the class
     * @param Property $property
     * @param mixed $isEdit
     * @return void
     */
    public function mount(Property $property, $isEdit = false): void
    {
        $this->imageUrl          = config('filesystems.disks.s3.url');
        $this->property          = $property;
        $this->isEdit            = $isEdit;
        $this->propertyId        = $property->id;
        $this->propertyReference = $property->reference;

        if ($isEdit && ($property && $property->photos()->exists())) {
            $this->photos = $property->photos()->orderBy('sort_order')->get();
        }

        // load tempt Images which is not yet stored in database
        // $this->getS3TempPhotos();
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

    /**
     * Summary of refreshPhotoList
     * @return void
     */
    public function refreshPhotoList(): void
    {
        $this->photos = PropertyFile::where('property_id', $this->propertyId)
                        ->where('type', 'gallery')
                        ->orderBy('sort_order')
                        ->get();

        $this->isListFresh = 'true';
    }

    /**
     * Reset input file
     */
    public function resetInputFile()
    {
        $this->reset('file'); // clear the input file value
        $this->file = null;
        $this->fileInputId++; // new input file id
    }

    /**
     * Will reorder the images according to the sets
     * @param iterable $orderedIds
     * @return void
     */
    public function reOrder(iterable $orderedIds)
    {
        foreach ($orderedIds as $index => $id) {
            try {
                PropertyFile::where('id', $id)->update([
                    'sort_order' => $index + 1
                ]);
            } catch (ErrorException $e) {
                Log::error('Sorting properties: ' . $e);
                throw $e;
            }
        }

        // Refresh list
        $this->refreshPhotoList();
    }

    /**
     * This will hundle the next page or next property form
     * 
     */
    #[On('parentNextStepButtonTriggered')]
    public function handleNextStepButtonTriggered()
    {
        $this->dispatch( 'proceed-to-next-step', property_id: $this->property->id);
        
    }

    /**
     * Save to database on every uploaded images
     * Storage: AWS s3 bucket
     */
    public function savePhotos(array $files)
    {
        Log::info('duplicate filename count: ' . json_encode($files));

        foreach ($files as $file) {
            try {

                $plainFilename = substr($file['orig_filename'], 0, -(((int) strlen($file['ext'])) + 1));
                
                //check if the photo already exist on respective propety
                $duplicateFilenames = PropertyFile::whereRaw('orig_filename REGEXP ?', [
                                    '^' . $plainFilename . '(\\([0-9]+\\))?\\.[a-zA-Z0-9]+$'
                                ])
                                ->where([
                                    'type' => 'gallery',
                                    'property_id' => $this->propertyId
                                ])->get()->toArray();

                // if image name already exist, then trancate image name with adding number at the end
                // e.g:  sample-image.jpg to sample-image(1).jpg
                $totalDuplicate = count($duplicateFilenames);
                if ($totalDuplicate !== 0) {
                    $file['orig_filename'] = "{$plainFilename}({$totalDuplicate}).{$file['ext']}";
                }

                Log::info('duplicate filename count: ' . $totalDuplicate);
                Log::info('duplicate filename: ' . $file['orig_filename']);

                // get the total number of properties and plus 1 for the sorting of the images
                // $total count + 1 = sort number of the new photo
                $lastSortNumber = PropertyFile::where([
                        'type' => 'gallery',
                        'property_id' => $this->propertyId
                    ])->count() + 1;
                // dd($lastSortNumber);
                // Store the new photo
                PropertyFile::updateOrCreate([
                    'orig_filename' => $file['orig_filename'],
                    'property_id' => $this->propertyId,
                ],[
                    'type' => 'gallery',
                    'path' => $file['path'],
                    'url' => $file['url'],
                    'orig_filename' => $file['orig_filename'],
                    'sort_order' => $lastSortNumber,
                ]);

                $this->resetInputFile();

            } catch (ErrorException $e) {
                Log::error('Saving uploaded photos error: ' . $e);
                throw $e;
            }
        }
        
        // refresh the image list
        $this->refreshPhotoList();
    }


    /*******************************
     * Delete warning Modal
     */
    public function openWarningDeleteModal(int $propertyPhotoId)
    {
        $this->selectDeletePhoto = PropertyFile::find($propertyPhotoId);

        $this->showModal = true;

    }

    /*******************************
     * Just close the warning delete modal
     **/
    public function closeWarningDeleteModal()
    {
        // refresh the image list
        $this->showModal = false;

        $this->selectDeletePhoto = null;
    }

    /*******************************
     * Delete photo from database to AWS S3
     */
    public function deletePhoto(int $propertyPhotoId)
    {
        $item = PropertyFile::find($propertyPhotoId);

        Storage::disk('s3')->delete($item->path);

        $item->delete();

        $photo = PropertyFile::where('type', 'gallery')
            ->orderBy('sort_order')->first();

        if (isset($photo->id)) {
            $this->reOrder([$photo->id]);
        }

        $this->selectDeletePhoto = null;
        
        // refresh the image list
        $this->refreshPhotoList();
        $this->showModal = false;
    }
    

    /**
     * Temporary file delete action
     * @param string $path
     * @return void
     */
    public function deleteTempFile(string $path)
    {
        Storage::disk('s3')->delete($path);
        $this->getS3TempPhotos();
    }

}
?>

<!-----------------------------------------------------------------------------
    Property Photos Upload and reordering the display in the WP/Website
------------------------------------------------------------------------------>

<div>
    <div class="flex max-w-7xl mt-3 mx-auto sm:px-6 lg:px-8">
        <div class="ml-auto text-blue-900 font-semibold font-custom pr-3">{{ $property->reference }}</div>
    </div>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Photos')  }}
                    </h3>
                    <p class="mb-5 text-sm text-gray-600">{{ __('Upload photos of the property. This will help your property show up in more search results and attract more potential buyers.') }}</p>
                    
                    <div x-data="uploadMultiple('{{ $propertyReference }}/gallery')" class="border rounded">

                        <!-------- To avoid traffic and multiple upload - recommend to upload single image only ---------->
                        <input id="dropzone-file" wire:model="file" type="file" 
                            @change="upload($event)" class="hidden" accept="image/webp, image/jpeg" 
                            $wire:key="{{ $fileInputId }}"/>

                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border border-dashed rounded cursor-pointer">
                            <div class="flex flex-col items-center justify-center text-body pt-2 pb-2">
                                    <svg class="w-8 h-8 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2"/></svg>
                                    <p class="mb-2 text-sm"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-center">Accepted formats: JPG & WEBP <br >(Max 2MB per file)</p>
                                </div>
                            </label>
                        </div>

                        @if (count($photos) == 0)
                    
                            <div class="p-5 text-center text-gray-500 bg-gray-200 text-sm">{{ __("No photos to view") }} </div>
                        
                        @else
                            <p class="p-5 text-sm text-gray-600"> {{ __('To organize property images, drag and drop them based on your preferred arrangement.') }}</p>
                        
                            <div
                                x-data="sortableImages()"
                                x-init="init()"
                                class="grid grid-cols-4 gap-3 p-3 bg-gray-200"
                            >
                                @foreach ( $photos as $key => $photo )
                                    <div 
                                        data-id="{{ $photo->id }}"
                                        class="border p-2 cursor-move bg-white shadow relative"
                                        x-data="{ isLoaded: false }"
                                        wire:key="section-{{ $photo->id }}"
                                        wire:sort:item="{{ $photo->id }}"
                                    >
                                        <!-- PROGRESS BAR -->
                                        <div wire:target="refreshed" :key="section-{{ $photo->id }}" role="progress" class="uploadStatus absolute inset-0 m-auto z-2" x-show="!isLoaded" wire:loading.remove>
                                            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                            </svg>
                                            <span class="sr-only">Loading...</span>
                                        </div> 

                                        <!----- SHOW MODAL FOR DELETE ----->
                                        <button :key="section-{{ $photo->id }}"  wire:target="deletePhoto" type="button" 
                                            wire:click="openWarningDeleteModal({{ $photo->id }})" 
                                            class="absolute right-2 top-2 z-2 text-white font-extrabold shadow bg-red-500 rounded text-sm p-1"
                                            title="Delete photo"
                                        >
                                            <svg class="w-4 h-4 text-white hover:text-red-200 cursor-pointer" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>

                                        <!------- RENDER IMAGE----------->
                                        <img src="{{ $photo->url }}"
                                            @load="isLoaded = true"
                                            x-init="if ($el.complete) isLoaded = true"
                                            x-show="isLoaded"
                                            class="transition-opacity duration-300"
                                            :key="section-{{ $photo->id }}"
                                        />
                                    </div>
                                @endforeach
                                @if($showModal)
                                    <div wire:target="deletePhoto" class="fixed inset-0 bg-gray-500/75 flex items-center justify-center">
                                        <!-- Modal Content -->
                                        <div class="bg-white p-6 rounded-lg shadow-xl max-w-sm mx-auto">
                                            <h3 class="text-lg font-bold text-gray-900">Warning</h3>
                                            <p class="mt-2 text-sm text-gray-500">This delete action cannot be undone. Proceed?</p>
                                            
                                            <div class="mt-4 flex justify-end space-x-2">
                                                <button
                                                    @click="$wire.set('showModal', 0)"
                                                    class="px-4 py-2 border rounded text-gray-700"
                                                >
                                                    Cancel
                                                </button>
                                                <button
                                                    wire:click="deletePhoto({{ $selectDeletePhoto->id }})"
                                                    wire:loading.class="opacity-50"
                                                    wire:target="deletePhoto"
                                                    class="px-4 py-2 bg-red-600 text-white rounded"
                                                >
                                                    <span wire:target="deletePhoto" wire:loading.remove>&#x21bb; {{ __('Confirm') }} </span>
                                                    <span wire:target="deletePhoto" wire:loading>
                                                        Deleting..
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                        @foreach($tempPhotos as $photo)
                            <p>{{ $photo  }}</p> 
                            <button type="button" wire:click="deleteTempFile('{{ $photo }}')">
                                Delete Account
                            </button>
                        @endforeach
                    </div> 
                </div>
            </div>
        </div>
    </div>
<?php /*
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
    @endif */ ?>
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
    /**@abstract */
    window.isUploading = function() {
        return this.files.some(file => file.progress < 100);
    }

    /***************************
     * Upload Multiple images
     ***************************/
    window.uploadMultiple = function (folder) {
        return {
            imageType: 'galleries',
            files: [],
            galleries: [], 

            async upload(event) {
                let uploads = [];

                for (let file of event.target.files) {
                    uploads.push(this.uploadSingle(file, folder));
                }

                await Promise.all(uploads);
                $wire.savePhotos(this[this.imageType]);

                this[this.imageType] = [];
                // @this.set('tempPhotos', this[this.imageType]);
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

                            // this.files.push({
                            //     orig_filename: res.orig_filename,
                            //     path: res.path,
                            //     url: res.url,
                            //     progress: fileProgress,
                            //     ext: res.ext
                            // });

                            this[this.imageType].push({
                                orig_filename: res.orig_filename,
                                path: res.path,
                                url: res.url,
                                ext: res.ext
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

/**@abstract Sorting feature */
window.sortableImages = function() {
    return {
        init() {
            let el = this.$el;

            new Sortable(el, {
                animation: 150,
                ghostClass: 'bg-gray-200',
                onEnd: () => {
                    let orderedIds = [];
                    console.log(el);
                    el.querySelectorAll('[data-id]').forEach(item => {
                        orderedIds.push(item.dataset.id);
                    });

                    this.$wire.reOrder(orderedIds);
                }
            });
        }
    }
}
</script>
@endscript