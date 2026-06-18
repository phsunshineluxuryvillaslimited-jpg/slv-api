<?php
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use App\Models\Property;
use App\Models\PropertyFile;
use App\Models\PropertyBank;
use App\Models\PropertyContactDetail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    #[Validate('required|string')]
    public string $first_name;

    #[Validate('required|string')]
    public string $last_name;

    #[Validate('required|string')]
    public string $phone_number;

    #[Validate('nullable')]
    public string $mobile_number;

    #[Validate('required|email')]
    public string $email;

    // #[Validate('nullable')]
    // public string $source = 'sample';

    #[Validate('nullable')]
    public string $notes;

    /********* Bank *************/
    #[Validate('required|string')]
    public string $bank_name;
    
    #[Validate('required|string')]
    public string $branch;

    #[Validate('required|string')]
    public string $account_ref;

    #[Validate('required|string')]
    public string $sort_code;

    #[Validate('required|string')]
    public string $account_name;

    #[Validate('required|string')]
    public string $account_number;

    #[Validate('required|string')]
    public string $address;

    #[Validate('required|string')]
    public string $contact_name;

    #[Validate('required|string')]
    public string $contact_phone;

     #[Validate('required|email')]
    public string $contact_email;
    /******************************/

    /********* Lawyer ************/
    #[Validate('required|string')]
    public string $lawyer_first_name;

    #[Validate('required|string')]
    public string $lawyer_last_name;
    
    #[Validate('required|string')]
    public string $lawyer_telephone_day;

    #[Validate('required|string')]
    public string $lawyer_email;

    #[Validate('required|string')]
    public string $lawyer_address;

    public ?Property $property;

    public ?PropertyBank $bank;

    public ?PropertyContactDetail $contact;

    public $vendorFiles = [];

    public object $user;

    public string $propertyReference;

    public bool $isEdit = false;

    public ?PropertyFile $selectedDeleteVendorFile;

    public bool $showModal = false;

    public function mount(Property $property, $isEdit = false): void
    {
        
        $this->property = $property;
        $this->isEdit   = $isEdit;
        $this->user     = Auth::user();
        $this->propertyReference = $property->reference;

        if ($property && $property->contact()->exists()) {
            $this->vendorFiles = PropertyFile::where([
                        'property_id' => $property->id,
                        'type' => 'document'
                    ]);
        }

        if ($isEdit) {

            $bank = PropertyBank::where([
                    'property_id' => $this->property->id
                ])->first();

            if ($bank) { 

                // $this->bank_name = ' '
                $this->branch           = $bank->branch;
                $this->account_ref      = $bank->account_ref;
                $this->sort_code        = $bank->sort_code;
                $this->account_name     = $bank->account_name;
                $this->account_number   = $bank->account_number;
                $this->address          = $bank->address;
                $this->contact_name     = $bank->contact_name;
                $this->contact_name     = $bank->contact_name;
                $this->contact_email    = $bank->contact_email;
            }

            $vendorDetail = PropertyContactDetail::where([
                                    'property_id' => $property->id,
                                ])->first();

            if ($vendorDetail) {

                $this->first_name            = $vendorDetail->first_name;
                $this->last_name             = $vendorDetail->last_name;
                $this->phone_number          = $vendorDetail->phone_number;
                $this->mobile_number         = $vendorDetail->mobile_number;
                $this->email                 = $vendorDetail->email;
                $this->notes                 = $vendorDetail->notes;
                $this->lawyer_first_name     = $vendorDetail->lawyer_first_name;
                $this->lawyer_last_name      = $vendorDetail->lawyer_last_name;
                $this->lawyer_telephone_day  = $vendorDetail->lawyer_telephone_day;
                $this->lawyer_email          = $vendorDetail->lawyer_email;
                $this->lawyer_address        = $vendorDetail->lawyer_address;
            }

            $this->refreshVendorFileList();
        }
        
    }

    #[On('parentNextStepButtonTriggered')]
    public function hundleNextStepButtonTriggered()
    {
        try {
            $validatedData = $this->validate();

            $bankData = [
                'property_id' => $this->property->id,                
                'bank_id' => 1,
                'branch' => $validatedData['branch'], 
                'contact_email' => $validatedData['contact_email'], 
                'sort_code' => $validatedData['sort_code'], 
                'account_name' => $validatedData['account_name'], 
                'account_number' => $validatedData['account_number'], 
                'address' => $validatedData['address'], 
                'contact_name' => $validatedData['contact_name'], 
                'contact_phone' => $validatedData['contact_phone'], 
                'account_ref' => $validatedData['account_ref'],
            ];

            PropertyBank::updateOrCreate([
                    'property_id' => $this->property->id,
                ],
                    $bankData 
            );

            PropertyContactDetail::updateOrCreate([
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

    /**
     * Update method for vendor's detail and bank details
     */
    #[On('parentUpdateButtonTriggered')]
    public function handleUpdateProperty()
    {   
        try {
            $validatedData = $this->validate();

            $validatedData['property_id'] = $this->property->id; 

            $bankData = [
                'property_id' => $this->property->id,                
                'bank_id' => 1,
                'branch' => $validatedData['branch'], 
                'contact_email' => $validatedData['contact_email'], 
                'sort_code' => $validatedData['sort_code'], 
                'account_name' => $validatedData['account_name'], 
                'account_number' => $validatedData['account_number'], 
                'address' => $validatedData['address'], 
                'contact_name' => $validatedData['contact_name'], 
                'contact_phone' => $validatedData['contact_phone'], 
                'account_ref' => $validatedData['account_ref'],
            ];

            PropertyBank::updateOrCreate([
                    'property_id' => $this->property->id,
                ],
                    $bankData 
            );

            PropertyContactDetail::updateOrCreate([
                    'property_id' => $this->property->id,
                ],
                $validatedData
            );

            session()->flash('success', 'Property updated successfully');
         } catch (ValidationException $e) {
            Log::info('Property validation error. Please double check.' . $e );
            throw $e;
        }
        
    }
    /**
     * Summary of refresh vendor files list
     * @return void
     */
    public function refreshVendorFileList(): void
    {
        $this->vendorFiles = PropertyFile::where('property_id', $this->property->id)
                        ->where('type', 'document')
                        ->orderBy('sort_order')
                        ->get();
    }

    /**
     * Save to database on every uploaded images
     * Storage: AWS s3 bucket
     */
    public function saveVendorFile(array $files)
    {
        foreach ($files as $file) {
            try {
                $plainFilename = substr($file['orig_filename'], 0, -(((int) strlen($file['ext'])) + 1));

                //check if the floor plan already exist on respective propety
                $duplicateFilenames = PropertyFile::whereRaw('orig_filename REGEXP ?', [
                                        '^' . $plainFilename . '(\\([0-9]+\\))?\\.[a-zA-Z0-9]+$'
                                    ])
                                    ->where([
                                        'type' => 'document',
                                        'property_id' => $this->property->id
                                    ])->get()->toArray();
                
                // if file name already exist, then trancate image name with adding number at the end
                // e.g:  sample-image.pdf to sample-image(1).pdf
                $totalDuplicate = count($duplicateFilenames);
                if ($totalDuplicate !== 0) {
                    $file['orig_filename'] = "{$plainFilename}({$totalDuplicate}).{$file['ext']}";
                }

                Log::info('duplicate filename count: ' . $totalDuplicate);
                Log::info('duplicate filename: ' . $file['orig_filename']);

                // get the total number of properties and plus 1 for the sorting of the images
                // $total count + 1 = sort number of the new photo
                $lastSortNumber = PropertyFile::where([
                    'type' => 'document',
                    'property_id' => $this->property->id
                ])->count() + 1;

                // Store the new photo
                PropertyFile::updateOrCreate([
                    'orig_filename' => $file['orig_filename'],
                    'property_id' => $this->property->id,
                ],[
                    'property_id' => $this->property->id,
                    'type' => 'document',
                    'path' => $file['path'],
                    'url' => $file['url'],
                    'orig_filename' => $file['orig_filename'],
                    'sort_order' => $lastSortNumber,
                ]);

            } catch (ErrorException $e) {
                Log::error('Saving uploaded photos error: ' . $e);
                throw $e;
            }
        }

        // refresh the image list
        $this->refreshVendorFileList();
    }


    /*******************************
     * Delete warning Modal
     */
    public function openWarningDeleteModal(int $propertyVendorFileId)
    {
        $this->selectedDeleteVendorFile = PropertyFile::find($propertyVendorFileId);

        $this->showModal = true;

    }

    /*******************************
     * Just close the warning delete modal
     **/
    public function closeWarningDeleteModal()
    {
        // refresh the image list
        $this->showModal = false;

        $this->selectedDeleteVendorFile = null;
    }

    /*******************************
     * Delete floor plan from database to AWS S3
     */
    public function deleteVendorFile(int $propertyVendorFileId)
    {
        $item = PropertyFile::find($propertyVendorFileId);

        Storage::disk('s3')->delete($item->path);

        $item->delete();

        $photo = PropertyFile::where('type', 'document')
            ->orderBy('sort_order')->first();

        if (isset($photo->id)) {
            $this->reOrder([$photo->id]);
        }

        $this->selectedDeleteVendorFile = null;

        // refresh the image list
        $this->refreshVendorFileList();

        $this->showModal = false;
    }


}    

?>

<!-----------------------------------------
Basic location info
----------------------------------------->
<div>
    <div class="max-w-7xl mt-3 mx-auto sm:px-6 lg:px-8">
        <span class="required-field"></span> <span class="text-sm text-gray-800">{{ __('Required fields') }}</span>
        <?php /* <div class="ml-auto text-blue-900 font-semibold font-custom pr-3">{{ $property->reference }}</div> */ ?>
    </div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Contact Details')  }}
                    </h3>
                    <p class="mb-5 text-sm text-gray-600">
                        {{ __('Add contact details for the property vendor. This will help potential buyers get in touch with you.') }}
                    </p>
                    <div class="">
                        <h4>{{ __('Category')  }}</h4>
                        <div class="pt-3 pb-5 text-sm">
                            <label class="mr-2"><input type="radio" name="category" value="Vendor" checked/>&nbsp;&nbsp;{{ __('Vendor') }}</label>
                            <label class="mr-2"></label><input type="radio" name="category" value="Agent" />&nbsp;&nbsp;{{ __('Agent') }}</label>
                            <label class="mr-2"></label><input type="radio" name="category" value="Developer" />&nbsp;&nbsp;{{ __('Developer') }}</label>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-2 gap-5 mb-4 mt-3">
                       <div>
                            <label for="firstName" class="required-field block text-black text-sm mb-1">{{ __('First Name') }}</label>
                            <input type="text" wire:model.live.debounce.500ms="first_name" id="firstName" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('first_name') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="lastName" class="required-field block text-black text-sm mb-1">{{ __('Last Name') }}</label>
                            <input type="text" wire:model.live.debounce.500ms="last_name" id="lastName" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('last_name') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
                        <div>
                            <label for="telephone" class="required-field block text-black text-sm mb-1">{{ __('Telephone') }}</label>
                            <input type="text" wire:model.live.debounce.500ms="phone_number" id="telephone" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('phone_number') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="mobile" class="required-field block text-black text-sm mb-1">{{ __('Mobile') }}</label>
                            <input type="text"  wire:model.live.debounce.500ms="mobile_number" id="mobile" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('mobile_number') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="email" class="required-field block text-black text-sm mb-1">{{ __('Email') }}</label>
                            <input type="email" wire:model.live.debounce.500ms="email" id="email" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('email') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-1/3">
                            <h5 class="text-sm mb-2">{{ __('Type') }}</h5>
                            <label class="mr-3"><input type="radio" name="type" value="vendor" checked/>&nbsp;&nbsp;{{ __('Vendor') }}</label>
                            <label class=""><input type="radio" name="type" value="landlord"/>&nbsp;&nbsp;{{ __('Landlord') }}</label>
                        </div>
                        <!-- <div class="w-full">
                            <label for="" class="block text-black text-sm mb-1">{{ __('Source') }}</label>
                            <select wire:model="source" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="sample1">{{ __('Sample 1') }}</option>
                                <option value="sample2">{{ __('Sample 2') }}</option>
                            </select>
                        </div> -->
                    </div>
                    <div class="py-5">
                        <label class="text-sm">{{ __('Notes') }}</label>
                        <textarea wire:model.live.debounce.500ms="notes" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 h-32"></textarea>
                    </div>
                    <div class="">
                        <label class="text-sm">{{ __('Vendor Documents') }}</label>
                        <div x-data="uploadVendorDocument('{{ $propertyReference }}/document')" class="border rounded">

                        <!-------- To avoid traffic and multiple upload - recommend to upload single image only ---------->
                        <input id="dropzone-file" type="file" @change="upload($event)" 
                            class="hidden" 
                            accept=".doc, .docx, .pdf, .csv, .xlsx, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf, text/csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                        />

                        <div class="flex items-center justify-center w-full bg-green-100">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 bg-neutral-secondary-medium border border-dashed border-default-strong rounded-base cursor-pointer hover:bg-neutral-tertiary-medium">
                                <div class="flex flex-col items-center justify-center text-body pt-2 pb-2">
                                    <svg class="w-8 h-8 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2"/></svg>
                                    <p class="mb-2 text-sm"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-center">Accepted formats: DOCX, PDF, XLSX, CSV <br >(Max 2MB per file)</p>
                                </div>
                                <input id="dropzone-file" type="file" class="hidden" />
                            </label>
                        </div>
                        
                        @if (count($vendorFiles) == 0)
                        
                            <div class="p-5 text-center text-gray-500 bg-gray-200 text-sm">{{ __("No files to view") }} </div>
                        
                        @else

                            <div
                                class="grid grid-cols-4 gap-3 p-3 bg-gray-200"
                            >
                                @foreach ( $vendorFiles as $key => $vendorFile )
                                    <div 
                                        data-id="{{ $vendorFile->id }}"
                                        class="border p-2 bg-white shadow relative"
                                        x-data="{ isLoaded: false }"
                                        wire:key="section-{{ $vendorFile->id }}"
                                    >
                                        <!-- PROGRESS BAR -->
                                        <?php
                                        /*<div wire:target="refreshed" :key="section-{{ $floorPlan->id }}" role="progress" class="uploadStatus absolute inset-0 m-auto z-2" x-show="!isLoaded" wire:loading.remove>
                                            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                            </svg>
                                            <span class="sr-only">Loading...</span>
                                        </div> 
                                        */ ?>
                                        <!----- SHOW MODAL FOR DELETE ----->
                                        <button :key="section-{{ $vendorFile->id }}"  wire:target="deletePhoto" type="button" 
                                            wire:click="openWarningDeleteModal({{ $vendorFile->id }})" 
                                            class="absolute right-2 top-2 z-2 text-white font-extrabold shadow bg-red-500 rounded text-sm p-1"
                                            title="Delete photo"
                                        >
                                            <svg class="w-4 h-4 text-white hover:text-red-200 cursor-pointer" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>

                                        <!------- RENDER IMAGE----------->
                                        <div
                                            @load="isLoaded = true"
                                            x-init="if ($el.complete) isLoaded = true"
                                            class="transition-opacity duration-300"
                                            :key="section-{{ $vendorFile->id }}"
                                        >
                                            <a href="{{ $vendorFile->url }}" target="_blank">
                                                {{ $vendorFile->orig_filename }}
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                                @if($showModal)
                                    <div wire:target="deleteVendorFile" class="fixed inset-0 bg-gray-500/75 flex items-center justify-center">
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
                                                    wire:click="deleteVendorFile({{ $selectedDeleteVendorFile->id ?? 'null' }})"
                                                    wire:loading.class="opacity-50"
                                                    wire:target="deleteVendorFile"
                                                    class="px-4 py-2 bg-red-600 text-white rounded"
                                                >
                                                    <span wire:target="deleteVendorFile" wire:loading.remove>&#x21bb; {{ __('Confirm') }} </span>
                                                    <span wire:target="deleteVendorFile" wire:loading>
                                                        Deleting..
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                         @endif
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Bank Details')  }}
                    </h3>
                    <p class="mb-5 text-sm text-gray-600">
                        {{ __('Add bank details for the property vendor. This will help potential buyers get in touch with you.') }}
                    </p>
                    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
                        <div>
                            <label for="bank_name" class="required-field block text-black text-sm mb-1">{{ __('Bank Name') }}</label>
                            <input type="text" wire:model.live.debounce.500ms="bank_name" id="bank_name" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('bank_name') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror        
                        </div>
                        <div>
                            <label for="branch" class="required-field block text-black text-sm mb-1">{{ __('Bank Branch') }}</label>
                            <input type="text" wire:model.live.debounce.500ms="branch" id="branch" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('branch') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="account_ref" class="required-field block text-black text-sm mb-1">{{ __('Account Reference') }}</label>
                            <input type="text" wire:model.live.debounce.500ms="account_ref" id="account_ref" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('account_ref') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-2 gap-5 mb-4">
                        <div>
                            <label for="account_name" class="required-field block text-black text-sm mb-1">{{ __('Account Name') }}</label>
                            <input type="text" wire:model.live.debounce.500ms="account_name" id="account_name" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('account_name') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="account_number" class="required-field block text-black text-sm mb-1">{{ __('Accunt Number') }}</label>
                            <input type="text" wire:model.live.debounce.500ms="account_number" id="account_number" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('account_number') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <div>
                            <label for="address" class="required-field block text-black text-sm mb-1">{{ __('Address') }}</label>
                            <input type="text" wire:model.live.debounce.500ms="address" id="address" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('address') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-2 gap-5 mb-4">
                        <div>
                            <label for="contact_name" class="required-field block text-black text-sm mb-1">{{ __('Contact Name') }}</label>
                            <input type="text" wire:model.live.debounce.500ms="contact_name" id="contact_name" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('contact_name') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="contact_phone" class="required-field block text-black text-sm mb-1">{{ __('Contact Phone') }}</label>
                            <input type="text" wire:model.live.debounce.500ms="contact_phone" id="contact_phone" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('contact_phone') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="contact_email" class="required-field block text-black text-sm mb-1">{{ __('Contact Email') }}</label>
                            <input type="email" wire:model.live.debounce.500ms="contact_email" id="contact_email" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('contact_email') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="sort_code" class="required-field block text-black text-sm mb-1">{{ __('Sort Code') }}</label>
                            <input type="text" wire:model.live.debounce.500ms="sort_code" id="sort_code" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('sort_code') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Lawyer Details')  }}
                    </h3>
                    <p class="mb-5 text-sm text-gray-600">
                        {{ __('Add contact details for the property lawyer. This will help potential buyers get in touch with you.') }}
                    </p>
                    <div class="grid grid-cols-4 md:grid-cols-4 gap-5 mb-4">
                        <div>
                            <label for="layerFirstName" class="required-field block text-black text-sm mb-1">{{ __('First Name') }}</label>
                            <input type="text" wire:model.live.debounce.500ms="lawyer_first_name" id="lawyerFirstName" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('lawyer_first_name') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror    
                        </div>
                        <div>
                            <label for="layerLastNamew" class="required-field block text-black text-sm mb-1">{{ __('Last Name') }}</label>
                            <input type="text" wire:model.live.debounce.500ms="lawyer_last_name" id="lawyerLastNamew" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('lawyer_last_name') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="layerTelephoneDay" class="required-field block text-black text-sm mb-1">{{ __('Telephone') }}</label>
                            <input type="text" wire:model.live.debounce.500ms="lawyer_telephone_day" id="lawyerTelephoneDay" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('lawyer_telephone_day') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="layerEmail" class="required-field block text-black text-sm mb-1">{{ __('Email') }}</label>
                            <input type="email" wire:model.live.debounce.500ms="lawyer_email" id="lawyerEmail" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('lawyer_email') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="">
                        <label class="required-field block text-black text-sm mb-1">{{ __('Address') }}</label>
                        <textarea wire:model.live.debounce.500ms="lawyer_address" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 h-32"></textarea>
                        @error('lawyer_address') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <?php /*
    @if ($errors->any())
        <div x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 2500)"
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
    @endif */?>
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
    let fileType = 'document';

    /***************************
     * Upload Multiple Files
     ***************************/
    window.uploadVendorDocument = function (folder) {
        return {
            fileType: 'document',
            document: [],

            async upload(event) {
                showLoading = true;

                let uploads = [];

                for (let file of event.target.files) {
                    uploads.push(this.uploadSingle(file, folder));
                }

                await Promise.all(uploads);

                $wire.saveVendorFile(this[this.fileType]);

                this[this.fileType] = [];
            },

            uploadSingle(file, folder) {
                return new Promise((resolve, reject) => {

                    let formData = new FormData();
                    formData.append('file', file);
                    formData.append('folder', folder);

                    const xhr = new XMLHttpRequest();

                    xhr.open('POST', '/s3/file-upload', true);
                    xhr.setRequestHeader(
                        'X-CSRF-TOKEN',
                        document.querySelector('meta[name="csrf-token"]').content
                    );

                    xhr.onload = () => {
                        if (xhr.status === 200) {
                            const res = JSON.parse(xhr.responseText);

                            this[this.fileType].push({
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
</script>
@endscript