
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
                        {{ __('Custom Fields')  }}
                    </h3>
                    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
                        
                    </div>
                </div>  
            </div>
        </div>
    </div>
</form>