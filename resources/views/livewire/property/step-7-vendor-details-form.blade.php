<?php
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use App\Models\PropertyAddress;

new class extends Component
{
    #[Validate('required|string')]
    public string $contact_details_first_name;

    #[Validate('required|string')]
    public string $contact_details_last_name;

    #[Validate('required|string')]
    public string $contact_details_telephone;

    #[Validate('required|string')]
    public string $contact_details_mobile;

    #[Validate('required|email')]
    public string $contact_details_email;

    #[Validate('required|string')]
    public string $lawyer_first_name;

    #[Validate('required|string')]
    public string $lawyer_last_name;
    
    #[Validate('required|string')]
    public string $lawyer_telephone_mobile;

    #[Validate('required|string')]
    public string $lawyer_email;

    #[Validate('required|string')]
    public string $lawyer_address;
}

?>

<!-----------------------------------------
Basic location info
----------------------------------------->
<div>
    <div class="max-w-7xl mt-3 mx-auto sm:px-6 lg:px-8">
        <span class="required-field"></span> <span class="text-sm text-gray-800">{{ __('Required fields') }}</span>
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
                            <label class="mr-2"><input type="radio" name="category" value="vendor" checked/>&nbsp;&nbsp;{{ __('Vendor') }}</label>
                            <label class="mr-2"></label><input type="radio" name="category" value="agent" />&nbsp;&nbsp;{{ __('Agent') }}</label>
                            <label class="mr-2"></label><input type="radio" name="category" value="developer" />&nbsp;&nbsp;{{ __('Developer') }}</label>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-2 gap-5 mb-4 mt-3">
                       <div>
                            <label for="firstName" class="required-field block text-black text-sm mb-1">{{ __('First Name') }}</label>
                            <input type="text" name="contact_details_first_name" id="firstName" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="lastName" class="required-field block text-black text-sm mb-1">{{ __('Last Name') }}</label>
                            <input type="text" name="contact_details_last_name" id="lastName" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
                        <div>
                            <label for="firstName" class="block text-black text-sm mb-1">{{ __('Telephone') }}</label>
                            <input type="text" name="contact_details_telephone" id="telephone" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="lastName" class="required-field block text-black text-sm mb-1">{{ __('Mobile') }}</label>
                            <input type="text" name="contact_details_mobile" id="mobile" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="email" class="required-field block text-black text-sm mb-1">{{ __('Email') }}</label>
                            <input type="email" name="contact_details_email" id="email" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-1/3">
                            <h5 class="text-sm mb-2">{{ __('Type') }}</h5>
                            <label class="mr-3"><input type="radio" name="category_type" value="vendor" checked/>&nbsp;&nbsp;{{ __('Vendor') }}</label>
                            <label class=""><input type="radio" name="category_type" value="landlord"/>&nbsp;&nbsp;{{ __('Landlord') }}</label>
                        </div>
                        <div class="w-full">
                            <label for="" class="block text-black text-sm mb-1">{{ __('Source') }}</label>
                            <select name="contact_details_source" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="sample1">{{ __('Sample 1') }}</option>
                                <option value="sample2">{{ __('Sample 2') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="py-5">
                        <label class="text-sm">{{ __('Notes') }}</label>
                        <textarea name="contact_details_notes" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 h-32"></textarea>
                    </div>
                    <div class="">
                        <label class="text-sm">{{ __('Vendor Documents') }}</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-44 bg-neutral-secondary-medium border border-dashed border-default-strong rounded-base cursor-pointer hover:bg-neutral-tertiary-medium">
                                <div class="flex flex-col items-center justify-center text-body pt-2 pb-2">
                                    <svg class="w-8 h-8 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2"/></svg>
                                    <p class="mb-2 text-sm"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-center">Accepted formats: PDF, DOC or DOCX <br >(Max 20MB per file)</p>
                                </div>
                                <input id="dropzone-file" type="file" class="hidden" />
                            </label>
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
                            <input type="text" name="lawyer_first_name" id="lawyerFirstName" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="layerLastNamew" class="required-field block text-black text-sm mb-1">{{ __('Last Name') }}</label>
                            <input type="text" name="lawyer_last_name" id="lawyerLastNamew" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="layerTelephoneDay" class="required-field block text-black text-sm mb-1">{{ __('Telephone / Mobile') }}</label>
                            <input type="text" name="lawyer_telephone_mobile" id="lawyerTelephoneMobile" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="layerEmail" class="required-field block text-black text-sm mb-1">{{ __('Email') }}</label>
                            <input type="email" name="lawyer_email" id="lawyerEmail" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                    </div>
                    <div class="">
                        <label class="required-field block text-black text-sm mb-1">{{ __('Address') }}</label>
                        <textarea name="contact_details_notes" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 h-32"></textarea>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>