
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Developers') }}
        </h2>
    </x-slot>

    @if (session()->has('success'))
        <div id="messageSession" class="fixed top-15 right-5 bg-green-500 text-white px-4 py-3 rounded shadow-lg z-50" >
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-end w-full gap-4 py-2 my-2 action-tabs">
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <label for="showCount">Show</label>
            <div class="relative">
                <select id="showCount" class="appearance-none border border-gray-300 rounded-md pl-3 pr-8 py-1.5 text-sm text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                    <option value="10">{{ __('10') }}</option>
                    <option value="20">{{ __('20') }}</option>
                    <option value="50">{{ __('50') }}</option>
                    <option value="100">{{ __('100') }}</option>
                </select>
                <svg class="absolute w-4 h-4 text-gray-400 -translate-y-1/2 pointer-events-none right-2 top-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>

        <a href="{{ route('developer.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
            {{ __('+ Add Developer')  }}
        </a>
    </div>

    <div class="w-full overflow-x-auto border rounded-lg shadow-sm content-wrapper">
        <!-- List of the Developers Informations -->
        <table class="w-full text-sm text-left table-auto">
            <thead class="font-medium text-gray-600 border-b bg-gray-50">
                <tr>
                    <th class="px-6 py-3">
                        <span class="flex items-center gap-1">
                            DEVELOPERS NAME
                            <svg class="w-3 h-3 text-gray-400" viewBox="0 0 10 12" fill="currentColor">
                                <path d="M5 0L8 4H2L5 0Z"/>
                                <path d="M5 12L2 8H8L5 12Z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center gap-1">
                            EMAIL
                            <svg class="w-3 h-3 text-gray-400" viewBox="0 0 10 12" fill="currentColor">
                                <path d="M5 0L8 4H2L5 0Z"/>
                                <path d="M5 12L2 8H8L5 12Z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center gap-1">
                            Mobile
                            <svg class="w-3 h-3 text-gray-400" viewBox="0 0 10 12" fill="currentColor">
                                <path d="M5 0L8 4H2L5 0Z"/>
                                <path d="M5 12L2 8H8L5 12Z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center gap-1">
                            PHONE NUMBER
                            <svg class="w-3 h-3 text-gray-400" viewBox="0 0 10 12" fill="currentColor">
                                <path d="M5 0L8 4H2L5 0Z"/>
                                <path d="M5 12L2 8H8L5 12Z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center gap-1">
                            MOBILE NUMBER
                            <svg class="w-3 h-3 text-gray-400" viewBox="0 0 10 12" fill="currentColor">
                                <path d="M5 0L8 4H2L5 0Z"/>
                                <path d="M5 12L2 8H8L5 12Z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="px-6 py-3 text-center">
                        <span class="inline-flex items-center gap-1">
                            CREATED AT
                            <svg class="w-3 h-3 text-gray-400" viewBox="0 0 10 12" fill="currentColor">
                                <path d="M5 0L8 4H2L5 0Z"/>
                                <path d="M5 12L2 8H8L5 12Z"/>
                            </svg>
                        </span>
                    </th>
                </tr>
            </thead>

            <tbody id="developersTableBody" class="text-gray-600 divide-y">
            </tbody>
            
        </table>
    </div>

    <!-- PAGINATION AND SHOW RESULT -->
    <div class="flex items-center justify-between px-4 py-3 border-t border-gray-200 sm:px-6">
        <div class="flex justify-between flex-1 sm:hidden">
            <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Previous</a>
            <a href="#" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Next</a>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
               @if ( $developers->count() )
                    Showing {{ $developers->firstItem() }} to {{ $developers->lastItem() }} of {{ $developers->total() }} entries
                @else
                    Showing 0 entries
                @endif
            </div>
            
            <!----------------------------------
                Pagination
             ----------------------------------> 
            <div>
                <nav aria-label="Pagination" class="inline-flex -space-x-px rounded-md shadow-xs isolate">
                    {{-- Previous --}}
                    @if ( $developers->onFirstPage())
                        <div class="relative inline-flex items-center px-2 py-2 text-gray-400 rounded-l-md inset-ring inset-ring-gray-300">
                            <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                <path d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                        </div>
                    @else
                        <a href="{{ $developers->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-gray-400 rounded-l-md inset-ring inset-ring-gray-300 hover:text-gray-700 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                            <span class="sr-only">{{ __('Previous') }}</span>
                            <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                <path d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Page Number --}}
                    @foreach ($developers->getUrlRange(1, $developers->lastPage()) as $page => $url)
                        <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->
                        <a href="{{ $url }}" {!! $page == $developers->currentPage()
                            ? 'aria-current="page" class="relative z-10 inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-blue-700 focus:z-20 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"'
                            : 'class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"' !!}>
                        {{ $page }}
                        </a>
                    @endforeach
                   
                    {{-- Next --}}
                    @if ( $developers->hasMorePages() )
                        <a href="{{ $developers->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-gray-400 rounded-r-md inset-ring inset-ring-gray-300 hover:text-gray-700 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                            <span class="sr-only">{{ __('Next') }}</span>
                            <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                <path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <div class="relative inline-flex items-center px-2 py-2 text-gray-400 rounded-l-md inset-ring inset-ring-gray-300">
                            <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                <path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                        </div>
                    @endif
                </nav>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    const avatarColors = ['#CD7100', '#00A552', '#DCB601', '#009ACD', '#EB5736', '#226E34', '#692DE7', '#D52828', '#AC7DAD'];
    
    const developers = @json($developers->items() ?? []);
   
    function getInitials(name) {
        const parts = name.trim().split(' ');
        const first = parts[0]?.charAt(0) || '';
        const last = parts.length > 1 ? parts[parts.length - 1].charAt(0) : '';
        return (first + last).toUpperCase();
    }

    function getRandomColor() {
        return avatarColors[Math.floor(Math.random() * avatarColors.length)];
    }

    function renderDevelopers(limit) {
        const tbody = document.getElementById('developersTableBody');
        tbody.innerHTML = '';

        developers.slice(0, limit).forEach(developer => {
            if (!developer.avatarColor) {
                developer.avatarColor = getRandomColor();
            }

            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="flex px-6 py-3 people-identity">
                    <div class="flex items-center gap-3">
                        <div class="slv-avatar" style="background: ${developer.avatarColor};">${getInitials(developer.full_name)}</div>
                        <span class="font-bold text-blue-500">${developer.full_name}</span>
                    </div>
                </td>
                <td class="px-6 py-3">
                    <a class="font-bold text-blue-500 text-hover-link-amber" href="mailto:${developer.email}" target="_blank">${developer.email}</a>
                </td>
                <td class="px-6 py-3">${developer.email}</td>
                <td class="px-6 py-3">${developer.phone_number}</td>
                <td class="px-6 py-3"><span class="font-bold">${developer.mobile_number}</span></td>

                <td class="px-6 py-3 text-center">${developer.created_at}</td>
            `;
            tbody.appendChild(row);
        });
    }

    document.getElementById('showCount').addEventListener('change', (e) => {
        renderDevelopers(parseInt(e.target.value, 10));
    });

    renderDevelopers(10); // initial render

    /******************************************
     *  Removing success message element 
     ****************************************/
    document.addEventListener('DOMContentLoaded', function() {
        const messageBox = document.getElementById('messageSession');
        
        if (messageBox) {
            setTimeout(function() {
                messageBox.style.transition = 'opacity 0.5s ease';
                messageBox.style.opacity = '0';
                
                // Remove from DOM after fade out transition
                setTimeout(function() {
                    messageBox.remove();
                }, 5000); 
            }, 3000); // Wait 3 seconds before starting the fade
        }
    });
</script>
@endpush

</x-app-layout>