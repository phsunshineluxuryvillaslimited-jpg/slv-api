
<x-app-layout>

<div class="min-h-screen bg-[#f5f8fa] text-slate-700">
    <div class="flex flex-col min-h-screen lg:flex-row">

        {{-- ============================ LEFT PANEL ============================ --}}
        <aside class="w-full lg:w-[320px] shrink-0 bg-white border-r border-slate-200">
            {{-- Back + actions --}}
            <div class="flex items-center justify-between px-5 py-3 border-b border-slate-100">
                <a href="{{ url('/clients') }}"
                   class="flex items-center gap-1 text-sm font-medium text-slate-600 hover:text-blue-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Clients
                </a>
                <button class="flex items-center gap-1 text-sm font-medium text-blue-600 hover:text-blue-700">
                    Actions
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M5.5 7.5L10 12l4.5-4.5z" /></svg>
                </button>
            </div>

            {{-- Identity --}}
            <div class="px-5 pt-5">
                <div class="flex items-start gap-3">
                    <div class="flex items-center justify-center w-12 h-12 text-lg font-semibold text-white bg-red-600 rounded-full shrink-0">BH</div>
                    <div>
                        <h1 class="text-xl font-semibold leading-tight text-slate-900">Cristiano Ronaldo</h1>
                        <p class="text-sm text-slate-500">Client</p>
                        <a href="mailto:cr7@samplemail.com" class="text-sm text-blue-600 break-all hover:underline">cr7@samplemail.com</a>
                    </div>
                </div>

                {{-- Quick action buttons --}}
                <div class="grid grid-cols-6 gap-1 mt-5 text-center">
                    <button class="flex flex-col items-center gap-1 py-2 rounded-md hover:bg-slate-50 group">
                        <span class="flex items-center justify-center text-blue-600 border rounded-full w-9 h-9 border-slate-200 group-hover:border-blue-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        </span>
                        <span class="text-[11px] text-slate-600">Note</span>
                    </button>
                    <button class="flex flex-col items-center gap-1 py-2 rounded-md hover:bg-slate-50 group">
                        <span class="flex items-center justify-center text-blue-600 border rounded-full w-9 h-9 border-slate-200 group-hover:border-blue-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </span>
                        <span class="text-[11px] text-slate-600">Email</span>
                    </button>
                    <button class="flex flex-col items-center gap-1 py-2 rounded-md hover:bg-slate-50 group">
                        <span class="flex items-center justify-center text-blue-600 border rounded-full w-9 h-9 border-slate-200 group-hover:border-blue-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11 11 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                        </span>
                        <span class="text-[11px] text-slate-600">Call</span>
                    </button>
                    <button class="flex flex-col items-center gap-1 py-2 rounded-md hover:bg-slate-50 group">
                        <span class="flex items-center justify-center text-blue-600 border rounded-full w-9 h-9 border-slate-200 group-hover:border-blue-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                        </span>
                        <span class="text-[11px] text-slate-600">Task</span>
                    </button>
                    <button class="flex flex-col items-center gap-1 py-2 rounded-md hover:bg-slate-50 group">
                        <span class="flex items-center justify-center text-blue-600 border rounded-full w-9 h-9 border-slate-200 group-hover:border-blue-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </span>
                        <span class="text-[11px] text-slate-600">Meeting</span>
                    </button>
                    <button class="flex flex-col items-center gap-1 py-2 rounded-md hover:bg-slate-50 group">
                        <span class="flex items-center justify-center text-blue-600 border rounded-full w-9 h-9 border-slate-200 group-hover:border-blue-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01" /></svg>
                        </span>
                        <span class="text-[11px] text-slate-600">More</span>
                    </button>
                </div>
            </div>

            {{-- About this client --}}
            <div class="px-5 py-4 mt-4 border-t border-slate-100">
                <div class="flex items-center justify-between mb-3">
                    <button class="flex items-center gap-1 text-sm font-semibold text-slate-800">
                        <svg class="w-4 h-4 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path d="M5.5 7.5L10 12l4.5-4.5z" /></svg>
                        About this client
                    </button>
                    <button class="text-sm font-medium text-blue-600 hover:text-blue-700">Actions</button>
                </div>

                <dl class="space-y-3">
                    <div><dt class="text-xs text-slate-500">Email</dt><dd class="text-sm break-words text-slate-800">cr7@samplemail.com</dd></div>
                    <div><dt class="text-xs text-slate-500">Mobile</dt><dd class="text-sm break-words text-slate-800">4234524534634</dd></div>
                    <div><dt class="text-xs text-slate-500">Contact owner</dt><dd class="text-sm break-words text-slate-800">Hazel</dd></div>
                    <div><dt class="text-xs text-slate-500">Client status</dt><dd class="text-sm break-words text-slate-800">Active</dd></div>
                    <div><dt class="text-xs text-slate-500">Lead status</dt><dd class="text-sm break-words text-slate-800">New</dd></div>
                    <div><dt class="text-xs text-slate-500">Last status</dt><dd class="text-sm break-words text-slate-800">01/01/0001 00:00:00</dd></div>
                    <div><dt class="text-xs text-slate-500">Record source</dt><dd class="text-sm break-words text-slate-800">SLV Processing</dd></div>
                </dl>
            </div>

            {{-- Communication subscriptions --}}
            <div class="px-5 py-4 border-t border-slate-100">
                <button class="flex items-center gap-1 text-sm font-semibold text-slate-800">
                    <svg class="w-4 h-4 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path d="M5.5 7.5L10 12l4.5-4.5z" /></svg>
                    Communication subscriptions
                </button>
                <p class="mt-2 text-xs leading-relaxed text-slate-500">Manage the communications this client receives from you.</p>
            </div>
        </aside>

        {{-- ============================ MIDDLE COLUMN ============================ --}}
        <main class="flex-1 min-w-0">
            {{-- Tabs --}}
            <div class="px-6 bg-white border-b border-slate-200">
                <nav class="flex items-center gap-8 text-sm">
                    <button class="py-4 font-semibold border-b-2 border-blue-600 text-slate-900">Overview</button>
                    <button class="py-4 text-slate-500 hover:text-slate-800">Activities</button>
                </nav>
            </div>

            <div class="p-6 space-y-6">
                {{-- Data highlights --}}
                <section class="bg-white border rounded-lg border-slate-200">
                    <div class="flex items-center justify-between px-5 py-3 border-b border-slate-100">
                        <h2 class="text-sm font-semibold text-slate-800">Data highlights</h2>
                        <button class="text-slate-400 hover:text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 gap-6 px-5 py-5 sm:grid-cols-3">
                        <div>
                            <p class="text-[11px] font-semibold tracking-wide text-slate-400 uppercase">Create date</p>
                            <p class="mt-1 text-sm text-slate-800">03/28/2025 12:01 PM GMT+8</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold tracking-wide text-slate-400 uppercase">Vendor status</p>
                            <p class="mt-1 text-sm text-slate-800">Active</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold tracking-wide text-slate-400 uppercase">Last activity date</p>
                            <p class="mt-1 text-sm text-slate-800">--</p>
                        </div>
                    </div>
                </section>

                {{-- Recent activities --}}
                <section class="bg-white border rounded-lg border-slate-200">
                    <div class="px-5 py-4 border-b border-slate-100">
                        <h2 class="mb-3 text-sm font-semibold text-slate-800">Recent activities</h2>
                        <div class="flex flex-wrap items-center gap-3">
                            <div class="relative flex-1 min-w-[180px]">
                                <svg class="absolute w-4 h-4 -translate-y-1/2 left-3 top-1/2 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" /></svg>
                                <input type="text" placeholder="Search activities" class="w-full py-2 pr-3 text-sm border rounded-md pl-9 border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400">
                            </div>
                            <button class="flex items-center gap-1 px-3 py-2 text-sm border rounded-md border-slate-300 text-slate-600 hover:bg-slate-50">
                                Add activities
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M5.5 7.5L10 12l4.5-4.5z" /></svg>
                            </button>
                            <button class="ml-auto text-sm text-blue-600 hover:text-blue-700">Collapse all</button>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-3">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs text-blue-700 bg-blue-50 rounded-md">Activity (5/9)</span>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs text-blue-700 bg-blue-50 rounded-md">All time so far</span>
                        </div>
                    </div>
                    <div class="px-5 py-12 text-center">
                        <svg class="w-10 h-10 mx-auto text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" /></svg>
                        <p class="mt-3 text-sm font-medium text-slate-700">No activities match the current filters</p>
                        <p class="text-xs text-slate-500">Change filters to broaden your search.</p>
                    </div>
                </section>

                {{-- Properties associated --}}
                <section class="bg-white border rounded-lg border-slate-200">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                        <h2 class="text-sm font-semibold text-slate-800">Properties</h2>
                        <button class="flex items-center gap-1 text-sm text-blue-600 hover:text-blue-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                            Add
                        </button>
                    </div>
                    <p class="px-5 py-8 text-sm text-center text-slate-500">No associated properties exist yet.</p>
                </section>
            </div>
        </main>

        {{-- ============================ RIGHT PANEL ============================ --}}
        <aside class="w-full lg:w-[340px] shrink-0 bg-[#f5f8fa] border-l border-slate-200 p-4 space-y-4">
            {{-- AI summary --}}
            <section class="bg-white border rounded-lg border-slate-200">
                <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100">
                    <h3 class="flex items-center gap-2 text-sm font-semibold text-slate-800">
                        Client Form
                    </h3>
                </div>
                <div class="px-4 py-4">
                    <input class="w-full mb-3 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled" type="text" name="clientName" value="Cristiano Ronaldo">
                    <input class="w-full mb-3 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled" type="email" name="clientEmail" value="cr7@samplemail.com">
                    <input class="w-full mb-3 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled" type="date" name="clientScheduleDate" placeholder="Select Date">
                    <input class="w-full mb-3 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled" type="time" name="clientScheduleTime" placeholder="Select Time">
                    <!--<button class="w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Submit
                    </button>-->
                </div>
            </section>

            {{-- Developers Match --}}
            <section class="bg-white border rounded-lg border-slate-200">
                <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100">
                    <h3 class="text-sm font-semibold text-slate-800">Match Company (1)</h3>
                    <button class="flex items-center gap-1 text-sm text-blue-600 hover:text-blue-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                        Add
                    </button>
                </div>
                <div class="px-4 py-4">
                    <div class="flex items-center gap-2">
                        <span class="flex items-center justify-center px-2 text-xs font-bold rounded w-sm h-7 bg-slate-100 text-slate-500">3KM group</span>
                    </div>
                </div>
            </section>

            {{-- Deals --}}
            <section class="bg-white border rounded-lg border-slate-200">
                <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100">
                    <h3 class="text-sm font-semibold text-slate-800">Deals (0)</h3>
                    <button class="flex items-center gap-1 text-sm text-blue-600 hover:text-blue-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                        Add
                    </button>
                </div>
                <p class="px-4 py-4 text-xs text-slate-500">Track the revenue opportunities associated with this vendor.</p>
            </section>

            {{-- Budget --}}
            <section class="bg-white border rounded-lg border-slate-200">
                <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100">
                    <h3 class="text-sm font-semibold text-slate-800">Budget</h3>
                    <button class="flex items-center gap-1 text-sm text-blue-600 hover:text-blue-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                        Add
                    </button>
                </div>
                <div class="px-4 py-4">
                    <div class="flex items-center gap-2">
                        <span class="flex items-center justify-center px-2 text-xs font-bold rounded w-sm h-7 bg-slate-100 text-slate-500">500,000</span>
                    </div>
                </div>
            </section>

            {{-- Contracts --}}
            <section class="bg-white border rounded-lg border-slate-200">
                <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100">
                    <h3 class="text-sm font-semibold text-slate-800">Contracts (0)</h3>
                    <button class="flex items-center gap-1 text-sm text-blue-600 hover:text-blue-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                        Add
                    </button>
                </div>
                <p class="px-4 py-4 text-xs text-slate-500">Track the sales documents associated with this vendor.</p>
            </section>
        </aside>
    </div>
</div>
</x-app-layout>