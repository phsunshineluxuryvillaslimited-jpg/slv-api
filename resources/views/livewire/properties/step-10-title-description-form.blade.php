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

    #[Validate('boolean')]
    public bool $published = false;

    #[Validate('nullable')]
    public string $published_at;

    #[Validate('nullable')]
    public string $status;

    public ?Property $property = null;

    public bool $isEdit = false;

    // get the list of property types
    public function mount(Property $property,  $isEdit = false): void
    {
        $this->property = $property;
        $this->isEdit = $isEdit;
        $this->description = $property->description ?? '';
        $this->published = $property->published_at ? true : false;
    }

    /****************************************
     * Create Method
     ****************************************/
    #[On('parentNextStepButtonTriggered')]
    public function hundleNextStepButtonTriggered()
    { 
        try {

            $validatedData = $this->validate();

            if ($validatedData['published']) {
                $validatedData['published_at'] = now()->toDateTimeString();
                $validatedData['status'] = 'published';
            } else {
                $validatedData['published_at'] = null;
                $validatedData['status'] = null;
            }
            
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

            if ($validatedData['published']) {
                $validatedData['published_at'] = now()->toDateTimeString();
                $validatedData['status'] = 'published';
            } else {
                $validatedData['published_at'] = null;
                $validatedData['status'] = null;
            }
            $this->property->description  = $validatedData['description'];
            $this->property->published_at = $validatedData['published_at'];
            $this->property->status       = $validatedData['status'];
            $this->property->save();

            session()->flash('success', 'Property has been successfully updated!');
        }
    }
}

?>
<!-----------------------------------------
Basic location info
----------------------------------------->
<div>
    <div class="flex max-w-7xl mt-3 mx-auto sm:px-6 lg:px-8">
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
                        <label for="PropertyDescription" class="required-field">{{ __('Property Description')  }} <span class="text-gray-500">{{ __('2000 characters recommended') }}</span></label>
                        <input type="hidden" value="{{ $property->id }}" name="property_id" id="propertyID" />
                        
                       <div
                            wire:ignore
                            x-data="tinymceComponent()"
                            x-init="init()"
                            class="w-full"
                        >
                            <textarea x-ref="textarea" name="description"></textarea>
                            <input type="hidden" id="hiddenDescription" name="description" wire:model="description" :value="value">

                        @script
                        <script>
                            window.tinymceComponent = function() {
                                return {
                                    value: '',
                                    init() {
                                        tinymce.init({
                                            target: this.$refs.textarea,
                                            height: 300,
                                            menubar: false,
                                            license_key: 'gpl',
                                            plugins: 'lists link image table code',
                                            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
                                            setup: (editor) => {
                                                // Set initial value
                                                editor.on('init', () => {
                                                    editor.setContent(@this.get('description') ?? `{!! addslashes($property->description) !!}`);
                                                });

                                                // Sync TinyMCE → Alpine
                                                editor.on('keyup change', () => {
                                                    @this.set('description', editor.getContent());
                                                });
                                            }
                                        });
                                    }
                                }
                            }
                        </script>
                        @endscript
                        </div>
                    </div>
                    <div class="flex">
                        <label class="inline-flex ml-auto items-center cursor-pointer">
                            <input type="checkbox" wire:model="published" value="" class="sr-only peer">
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Publish this prorperty') }}</span>
                        </label>
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