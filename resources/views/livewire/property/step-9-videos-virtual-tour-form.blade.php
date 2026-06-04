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
                        {{ __('Videos / Virtual Tour')  }}
                    </h3>
                    <p class="mb-5 text-sm text-gray-600">{{ __('Add YouTube video links and virtual tour links for the property. This will help your property show up in more search results and attract more potential buyers.') }}</p>
                    <p class="mb-5 text-sm text-gray-600">{{ __('If you are unsure on how to get the YouTube embedded link, ') }} <a href="https://support.google.com/youtube/answer/171780?hl=en" target="_blank" class="text-blue-500">{{ __('click this link for help.') }}</a></p>
                    <div class="">
                        <div class="p-4 sm:p-8 bg-gray-50 border-t border-gray-200">
                            <label for="embed_url_1" class="block text-black text-sm mb-1">{{ __('YouTube Embedded Link 1:') }}</label>
                            <input type="text" 
                                    name="embed_url_1" 
                                    id="embed_url_1" 
                                    class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" required />
                        </div>
                        <div class="p-4 sm:p-8 bg-gray-50 border-t border-gray-200">
                            <label for="embed_url_2" class="block text-black text-sm mb-1">{{ __('YouTube Embedded Link 2:') }}</label>
                            <input type="text" 
                                    name="embed_url_2" 
                                    id="embed_url_2" 
                                    class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" required />
                        </div>
                        <div class="p-4 sm:p-8 bg-gray-50 border-t border-gray-200">
                            <label for="virtual_tour_link" class="block text-black text-sm mb-1 ">{{ __('Virtual Tour Link (Kuula etc.):') }}</label>
                            <input type="text" 
                                    name="virtual_tour_link" 
                                    id="virtual_tour_link" 
                                    class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" required />
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>  