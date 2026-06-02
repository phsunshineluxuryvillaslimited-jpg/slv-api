
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
                        {{ __('Channel Manager')  }}
                    </h3>
                    <div class="mb-4">
                        <h4 class="text-lg">External Feeds</h4>
                        <div class="flex py-2">
                            <label class="border-2 border-gray-300 text-slate-600 px-3 py-2 rounded text-sm tracking-wider has-[:checked]:border-blue-800 mr-3">
                                <input type="checkbox" name="external_feed[]" value="right_move" class="border rounded text-blue-800 h-5 w-5 mr-2" /> Right Move 
                            </label>
                            <label class="border-2 border-gray-300 text-slate-600 px-3 py-2 rounded text-sm tracking-wider has-[:checked]:border-blue-800 mr-3">
                                <input type="checkbox" name="external_feed[]" value="zoopla" class="border rounded text-blue-800 h-5 w-5 mr-2" /> Zoopla
                            </label>
                            <label class="border-2 border-gray-300 text-slate-600 px-3 py-2 rounded text-sm tracking-wider has-[:checked]:border-blue-800 mr-3">
                                <input type="checkbox" name="external_feed[]" value="barazaki" class="border rounded text-blue-800 h-5 w-5 mr-2" /> Barazaki
                            </label>
                            <label class="border-2 border-gray-300 text-slate-600 px-3 py-2 rounded text-sm tracking-wider has-[:checked]:border-blue-800 mr-3">
                                <input type="checkbox" name="external_feed[]" value="apits" class="border rounded text-blue-800 h-5 w-5 mr-2" /> APITS
                            </label>
                            <label class="border-2 border-gray-300 text-slate-600 px-3 py-2 rounded text-sm tracking-wider has-[:checked]:border-blue-800 mr-3">
                                <input type="checkbox" name="external_feed[]" value="zoopla" class="border rounded text-blue-800 h-5 w-5 mr-2" /> Zoopla
                            </label>
                            <label class="border-2 border-gray-300 text-slate-600 px-3 py-2 rounded text-sm tracking-wider has-[:checked]:border-blue-800 mr-3">
                                <input type="checkbox" name="external_feed[]" value="slv" class="border rounded text-blue-800 h-5 w-5 mr-2" /> SLV (Searchable on website)
                            </label>
                            <label class="border-2 border-gray-300 text-slate-600 px-3 py-2 rounded text-sm tracking-wider has-[:checked]:border-blue-800">
                                <input type="checkbox" name="external_feed[]" value="directs" value="directs" class="border rounded text-blue-800 h-5 w-5 mr-2" /> Directs
                            </label>
                        </div>
                        <hr class="my-5 border-gray-400" />
                        <h4 class="text-lg">Website Banner</h4>
                        <div class="flex py-2">
                            <label class="border-2 border-gray-300 text-slate-600 px-3 py-2 rounded text-sm tracking-wider has-[:checked]:border-blue-800 mr-3">
                                <input type="checkbox" name="webisite_banner[]" value="reduced" class="border rounded text-blue-800 h-5 w-5 mr-2" /> Reduced
                            </label>
                            <label class="border-2 border-gray-300 text-slate-600 px-3 py-2 rounded text-sm tracking-wider has-[:checked]:border-blue-800 mr-3">
                                <input type="checkbox" name="webisite_banner[]" value="reserved" class="border rounded text-blue-800 h-5 w-5 mr-2" /> Reserved
                            </label>
                            <label class="border-2 border-gray-300 text-slate-600 px-3 py-2 rounded text-sm tracking-wider has-[:checked]:border-blue-800 mr-3">
                                <input type="checkbox" name="webisite_banner[]" value="sold" class="border rounded text-blue-800 h-5 w-5 mr-2" /> Sold
                            </label>
                            <label class="border-2 border-gray-300 text-slate-600 px-3 py-2 rounded text-sm tracking-wider has-[:checked]:border-blue-800 mr-3">
                                <input type="checkbox" name="webisite_banner[]" value="exclusive" class="border rounded text-blue-800 h-5 w-5 mr-2" /> Exclusive
                            </label>
                            <label class="border-2 border-gray-300 text-slate-600 px-3 py-2 rounded text-sm tracking-wider has-[:checked]:border-blue-800 mr-3">
                                <input type="checkbox" name="webisite_banner[]" value="new listing" class="border rounded text-blue-800 h-5 w-5 mr-2" /> New Listing
                            </label>
                        </div>
                    </div>
                </div>  
            </div> 
        </div>
    </div>
    </form>