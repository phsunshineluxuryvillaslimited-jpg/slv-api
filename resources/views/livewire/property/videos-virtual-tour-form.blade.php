
<!-----------------------------------------------------
Add your form or content for adding a property here
------------------------------------------------------->
<form method="POST" action="{{ route('properties.store') }}">
@csrf

    <!-----------------------------------------
    Basic location info
    ----------------------------------------->
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Videos / Virtual Tour')  }}
                    </h3>
                    <p class="py-6">If you are unsure on how to get the YouTube embedded link, <a href="" class="text-blue-500">click this link for help</a>.</p>
                    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
                        <div class="">
                            <label for="embed_url_1">{{ __('YouTube Embedded Link 1:') }}</label>
                            <input type="text" name="embed_url_1" id="embed_url_1" class="w-full py-1 border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" required />
                        </div>
                        <div class="">
                            <label for="embed_url_2">{{ __('YouTube Embedded Link 2:') }}</label>
                            <input type="text" name="embed_url_2" id="embed_url_2" class="w-full py-1 border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" required />
                        </div>
                        <div class="">
                            <label for="virtual_tour_link">{{ __('Virtual Tour Link (Kuula etc.):') }}</label>
                            <input type="text" name="virtual_tour_link" id="virtual_tour_link" class="w-full py-1 border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" required />
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</form>