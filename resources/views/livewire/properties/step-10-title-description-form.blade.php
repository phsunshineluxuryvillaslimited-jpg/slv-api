<?php
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use App\Models\Property;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

new class extends Component
{
    #[Validate('required|string')]
    public string $description;

    public ?Property $property = null;

    public bool $isEdit = false;

    // get the list of property types
    public function mount(Property $property,  $isEdit = false): void
    {
        $this->property = $property;
        $this->isEdit = $isEdit;
        $this->description = $property->description ?? '';
    }

    /****************************************
     * Create Method
     ****************************************/
    #[On('parentNextStepButtonTriggered')]
    public function hundleNextStepButtonTriggered()
    { 
        try {

            $validatedData = $this->validate();
            
            $this->property->address()->updateOrCreate([
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

     /****************************************
     * Edit Method
     ****************************************/
    #[On('parentUpdateButtonTriggered')]
    public function handleUpdateProperty()
    {
        
        $validatedData = $this->validate();

        if ($this->property && $this->property->exists) {

            $this->property->update($validatedData);

            session()->flash('success', 'Property has been successfully updated!');
        }
    }

}

?>
<!-----------------------------------------
Basic location info
----------------------------------------->
<div>
    <div class="max-w-7xl mt-3 mx-auto sm:px-6 lg:px-8">
        <span class="required-field"></span> <span class="text-sm text-gray-800">{{ __('Required fields') }}</span>
        <div class="ml-auto text-blue-900 font-semibold font-custom pr-3">{{ $property->reference }}</div>
    </div>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Property Description')  }}
                    </h3>
                    <div class="w-full">
                        @error('description')
                        <div class="bg-red-100 p-3 rounded-5"><span class="text-red-500 text-shadow-sm">{{ $message }}</span></div>
                        @enderror
                    </div>
                    <div class="w-full py-5">
                        <label for="description" class="required-field">{{ __('Property Description')  }} <span class="text-gray-500">{{ __('2000 characters recommended') }}</span></label>
                        
                        <div class="flex gap-5">
                            <div class="w-full">
                                <textarea wire:model.live="description" id="description" class="w-full h-64 text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" required></textarea> 
                                <span class="text-sm text-gray-400">2000 characters</span>
                            </div>

                            <div>
                                <button class="flex px-4 py-1 bg-gray-300 hover:bg-gray-400 rounded">
                                    <span class="pr-2">Generate</span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.99946 4.5C9.16242 4.50003 9.32094 4.55315 9.45103 4.6513C9.58112 4.74945 9.6757 4.8873 9.72046 5.044L10.5335 7.89C10.7085 8.50292 11.0369 9.0611 11.4876 9.51183C11.9384 9.96255 12.4965 10.2909 13.1095 10.466L15.9555 11.279C16.1121 11.3239 16.2498 11.4185 16.3478 11.5486C16.4459 11.6786 16.4989 11.8371 16.4989 12C16.4989 12.1629 16.4459 12.3214 16.3478 12.4514C16.2498 12.5815 16.1121 12.6761 15.9555 12.721L13.1095 13.534C12.4965 13.7091 11.9384 14.0374 11.4876 14.4882C11.0369 14.9389 10.7085 15.4971 10.5335 16.11L9.72046 18.956C9.6756 19.1126 9.58098 19.2503 9.4509 19.3484C9.32082 19.4464 9.16235 19.4995 8.99946 19.4995C8.83657 19.4995 8.6781 19.4464 8.54802 19.3484C8.41794 19.2503 8.32332 19.1126 8.27846 18.956L7.46546 16.11C7.29041 15.4971 6.96201 14.9389 6.51129 14.4882C6.06056 14.0374 5.50238 13.7091 4.88946 13.534L2.04346 12.721C1.88686 12.6761 1.74913 12.5815 1.65108 12.4514C1.55303 12.3214 1.5 12.1629 1.5 12C1.5 11.8371 1.55303 11.6786 1.65108 11.5486C1.74913 11.4185 1.88686 11.3239 2.04346 11.279L4.88946 10.466C5.50238 10.2909 6.06056 9.96255 6.51129 9.51183C6.96201 9.0611 7.29041 8.50292 7.46546 7.89L8.27846 5.044C8.32322 4.8873 8.4178 4.74945 8.54789 4.6513C8.67798 4.55315 8.8365 4.50003 8.99946 4.5ZM17.9995 1.5C18.1668 1.49991 18.3293 1.55576 18.4612 1.65869C18.5931 1.76161 18.6869 1.90569 18.7275 2.068L18.9855 3.104C19.2215 4.044 19.9555 4.778 20.8955 5.014L21.9315 5.272C22.0941 5.31228 22.2385 5.40586 22.3418 5.5378C22.445 5.66974 22.5011 5.83246 22.5011 6C22.5011 6.16754 22.445 6.33026 22.3418 6.4622C22.2385 6.59414 22.0941 6.68772 21.9315 6.728L20.8955 6.986C19.9555 7.222 19.2215 7.956 18.9855 8.896L18.7275 9.932C18.6872 10.0946 18.5936 10.2391 18.4617 10.3423C18.3297 10.4456 18.167 10.5017 17.9995 10.5017C17.8319 10.5017 17.6692 10.4456 17.5373 10.3423C17.4053 10.2391 17.3117 10.0946 17.2715 9.932L17.0135 8.896C16.8981 8.43443 16.6594 8.0129 16.323 7.67648C15.9866 7.34005 15.565 7.10139 15.1035 6.986L14.0675 6.728C13.9048 6.68772 13.7604 6.59414 13.6571 6.4622C13.5539 6.33026 13.4978 6.16754 13.4978 6C13.4978 5.83246 13.5539 5.66974 13.6571 5.5378C13.7604 5.40586 13.9048 5.31228 14.0675 5.272L15.1035 5.014C15.565 4.89861 15.9866 4.65995 16.323 4.32352C16.6594 3.9871 16.8981 3.56557 17.0135 3.104L17.2715 2.068C17.3121 1.90569 17.4058 1.76161 17.5377 1.65869C17.6696 1.55576 17.8321 1.49991 17.9995 1.5ZM16.4995 15C16.657 14.9999 16.8105 15.0494 16.9383 15.1415C17.0661 15.2336 17.1617 15.3636 17.2115 15.513L17.6055 16.696C17.7555 17.143 18.1055 17.495 18.5535 17.644L19.7365 18.039C19.8854 18.089 20.0149 18.1845 20.1067 18.3121C20.1984 18.4397 20.2478 18.5929 20.2478 18.75C20.2478 18.9071 20.1984 19.0603 20.1067 19.1879C20.0149 19.3155 19.8854 19.411 19.7365 19.461L18.5535 19.856C18.1065 20.006 17.7545 20.356 17.6055 20.804L17.2105 21.987C17.1604 22.136 17.0649 22.2655 16.9373 22.3572C16.8098 22.4489 16.6566 22.4983 16.4995 22.4983C16.3423 22.4983 16.1892 22.4489 16.0616 22.3572C15.934 22.2655 15.8385 22.136 15.7885 21.987L15.3935 20.804C15.3198 20.5833 15.1958 20.3827 15.0313 20.2182C14.8667 20.0537 14.6662 19.9297 14.4455 19.856L13.2625 19.461C13.1135 19.411 12.984 19.3155 12.8923 19.1879C12.8005 19.0603 12.7512 18.9071 12.7512 18.75C12.7512 18.5929 12.8005 18.4397 12.8923 18.3121C12.984 18.1845 13.1135 18.089 13.2625 18.039L14.4455 17.644C14.8925 17.494 15.2445 17.144 15.3935 16.696L15.7885 15.513C15.8382 15.3637 15.9336 15.2339 16.0612 15.1418C16.1888 15.0497 16.3421 15.0001 16.4995 15Z" fill="#1E1E1E"/>
                                    </svg>
                                </button>
                            </div>
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

<?php /*
<!-- Include stylesheet -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-beta.0/dist/quill.snow.css" rel="stylesheet" />

<!-- Create the editor container -->
<div id="editor">
  <p>Hello World!</p>
  <p>Some initial <strong>bold</strong> text</p>
  <p><br /></p>
</div>

<!-- Include the Quill library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-beta.0/dist/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
  const quill = new Quill('#editor', {
    theme: 'snow'
  });
</script>

*/?>