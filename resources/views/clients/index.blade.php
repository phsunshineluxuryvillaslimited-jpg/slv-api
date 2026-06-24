
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Agents') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-end w-full gap-4 py-2 my-2 action-tabs">
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <label for="showCount">Show</label>
            <div class="relative">
                <select id="showCount" class="appearance-none border border-gray-300 rounded-md pl-3 pr-8 py-1.5 text-sm text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <svg class="absolute w-4 h-4 text-gray-400 -translate-y-1/2 pointer-events-none right-2 top-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>

        <a href="{{ route('client.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
            Add Client 
        </a>
    </div>

    <div class="w-full overflow-x-auto border rounded-lg shadow-sm content-wrapper">
        <!-- List of the Agents Informations -->
        <table class="w-full text-sm text-left table-auto">
            <thead class="font-medium text-gray-600 border-b bg-gray-50">
                <tr>
                    <th class="px-6 py-3">
                        <span class="flex items-center gap-1">
                            AGENT NAME
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
                            CONTACT OWNER
                            <svg class="w-3 h-3 text-gray-400" viewBox="0 0 10 12" fill="currentColor">
                                <path d="M5 0L8 4H2L5 0Z"/>
                                <path d="M5 12L2 8H8L5 12Z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center gap-1">
                            PRIMARY COMPANY
                            <svg class="w-3 h-3 text-gray-400" viewBox="0 0 10 12" fill="currentColor">
                                <path d="M5 0L8 4H2L5 0Z"/>
                                <path d="M5 12L2 8H8L5 12Z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center gap-1">
                            LAST STATUS
                            <svg class="w-3 h-3 text-gray-400" viewBox="0 0 10 12" fill="currentColor">
                                <path d="M5 0L8 4H2L5 0Z"/>
                                <path d="M5 12L2 8H8L5 12Z"/>
                            </svg>
                        </span>
                    </th>
                </tr>
            </thead>

            <tbody id="agentTableBody" class="text-gray-600 divide-y">
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
            <p class="text-sm text-gray-700">
                Showing
                <span class="font-medium">10</span>
                to
                <span class="font-medium">10</span>
                of
                <span class="font-medium">97</span>
                results
            </p>
            </div>
            <div>
            <nav aria-label="Pagination" class="inline-flex -space-x-px rounded-md shadow-xs isolate">
                <a href="#" class="relative inline-flex items-center px-2 py-2 text-gray-400 rounded-l-md inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                <span class="sr-only">Previous</span>
                <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                    <path d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
                </a>
                <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->
                <a href="#" aria-current="page" class="relative z-10 inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-blue-700 focus:z-20 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">1</a>
                <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">2</a>
                <a href="#" class="relative items-center hidden px-4 py-2 text-sm font-semibold text-gray-900 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex">3</a>
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 inset-ring inset-ring-gray-300 focus:outline-offset-0">...</span>
                <a href="#" class="relative items-center hidden px-4 py-2 text-sm font-semibold text-gray-900 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex">8</a>
                <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">9</a>
                <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">10</a>
                <a href="#" class="relative inline-flex items-center px-2 py-2 text-gray-400 rounded-r-md inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                <span class="sr-only">Next</span>
                <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                    <path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
                </a>
            </nav>
            </div>
        </div>
    </div>

<script>
    const avatarColors = ['#CD7100', '#00A552', '#DCB601', '#009ACD', '#EB5736', '#226E34', '#692DE7', '#D52828', '#AC7DAD'];

    const agents = [
        { name: 'Alice Guytengco', email: 'alice@agent.com', mobile: '4234524534634', contactOwner: 'Hazel', primaryCompany: '3KM group', lastStatus: '01/01/0001 00:00:00' },
        { name: 'Jessie De Leon', email: 'jessie@agent.com', mobile: '4234524534634', contactOwner: 'Jasmine', primaryCompany: 'A-House', lastStatus: '01/01/0001 00:00:00' },
        { name: 'Mika Reyes', email: 'mika@agent.com', mobile: '4234524534634', contactOwner: 'Abby', primaryCompany: '5 Queens', lastStatus: '01/01/0001 00:00:00' },
        { name: 'Miu Schuette', email: 'miu@agent.com', mobile: '4234524534634', contactOwner: 'Hazel', primaryCompany: 'A&M Pittakas Developers', lastStatus: '01/01/0001 00:00:00' },
        { name: 'Becca Armstrong', email: 'becca@agent.com', mobile: '4234524534634', contactOwner: 'Yulya', primaryCompany: 'Develta Group', lastStatus: '01/01/0001 00:00:00' },
        { name: 'Lyndel Lin', email: 'lyndel@agent.com', mobile: '4234524534634', contactOwner: 'Yulya', primaryCompany: 'A.C Priority Homes', lastStatus: '01/01/0001 00:00:00' },
        { name: 'Maja Fernandez', email: 'maja@agent.com', mobile: '4234524534634', contactOwner: 'Jasmine', primaryCompany: 'AGG Luxury Homes', lastStatus: '01/01/0001 00:00:00' },
        { name: 'Rachel Violet', email: 'rachel@agent.com', mobile: '4234524534634', contactOwner: 'Hazel', primaryCompany: 'Aphroditehills realty', lastStatus: '01/01/0001 00:00:00' },
        { name: 'Der Hobbs', email: 'der@agent.com', mobile: '4234524534634', contactOwner: 'Abby', primaryCompany: 'Cyprus Dream Homes', lastStatus: '01/01/0001 00:00:00' },
        { name: 'Luka Doncic', email: 'luka@agent.com', mobile: '4234524534634', contactOwner: 'Hazel', primaryCompany: 'D.Zavos Group', lastStatus: '01/01/0001 00:00:00' },
    ];

    function getInitials(name) {
        const parts = name.trim().split(' ');
        const first = parts[0]?.charAt(0) || '';
        const last = parts.length > 1 ? parts[parts.length - 1].charAt(0) : '';
        return (first + last).toUpperCase();
    }

    function getRandomColor() {
        return avatarColors[Math.floor(Math.random() * avatarColors.length)];
    }

    function renderAgents(limit) {
        const tbody = document.getElementById('agentTableBody');
        tbody.innerHTML = '';

        agents.slice(0, limit).forEach(agent => {
            if (!agent.avatarColor) {
                agent.avatarColor = getRandomColor();
            }

            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="flex px-6 py-3 people-identity">
                    <a class="flex items-center gap-3" href="{{ route('agent-info') }}">
                        <div class="slv-avatar" style="background: ${agent.avatarColor};">${getInitials(agent.name)}</div>
                        <span class="font-bold text-blue-500">${agent.name}</span>
                    </a>
                </td>
                <td class="px-6 py-3">
                    <a class="font-bold text-blue-500 text-hover-link-amber" href="mailto:${agent.email}" target="_blank">${agent.email}</a>
                </td>
                <td class="px-6 py-3">${agent.mobile}</td>
                <td class="px-6 py-3">${agent.contactOwner}</td>
                <td class="px-6 py-3"><span class="font-bold">${agent.primaryCompany}</span></td>
                <td class="px-6 py-3">${agent.lastStatus}</td>
            `;
            tbody.appendChild(row);
        });
    }

    document.getElementById('showCount').addEventListener('change', (e) => {
        renderAgents(parseInt(e.target.value, 10));
    });

    renderAgents(10); // initial render
</script>

</x-app-layout> 