@php use Carbon\Carbon; @endphp

<div>
    @if (session('status'))
        <div class="px-4 py-3 mb-4 text-sm border rounded-lg bg-emerald-50 border-emerald-200 text-emerald-700">
            {{ session('status') }}
        </div>
    @endif

    {{-- Toolbar: month + member filters, Add Event button --}}
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <div class="flex flex-wrap items-center gap-3">
            <select wire:model.live="period"
                class="py-2 pl-3 pr-8 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                @foreach ($this->monthOptions as $option)
                    <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                @endforeach
            </select>

            <select wire:model.live="selectedMember"
                class="py-2 pl-3 pr-8 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                @foreach ($this->members as $name)
                    <option value="{{ $name }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <button type="button" wire:click="openModal"
            class="px-4 py-2 text-sm font-medium text-white bg-[#255A8A] rounded-lg hover:bg-[#2969a0]">
            + Add event
        </button>
    </div>

    {{-- Calendar card --}}
    <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-2xl">
        <div class="grid grid-cols-7 text-xs font-medium tracking-wide text-gray-500 uppercase border-b border-gray-100 bg-gray-50">
            @foreach (['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                <div class="px-3 py-2">{{ $day }}</div>
            @endforeach
        </div>

        @foreach ($this->calendarWeeks as $week)
            <div class="grid grid-cols-7">
                @foreach ($week as $day)
                    <div class="min-h-[110px] border-b border-r border-gray-100 p-2 last:border-r-0">
                        @if ($day['isToday'])
                            <span class="inline-flex items-center justify-center text-sm font-semibold text-white bg-[#255a8a] rounded-full h-7 w-7">
                                {{ $day['date']->format('j') }}
                            </span>
                        @else
                            <span class="text-sm {{ $day['inMonth'] ? 'text-gray-700' : 'text-gray-300' }}">
                                {{ $day['date']->format('j') }}
                            </span>
                        @endif

                        <div class="mt-1 space-y-1">
                            @foreach ($day['events'] as $event)
                                <div class="flex items-center justify-between gap-1 truncate rounded-md px-2 py-1 text-xs font-medium {{ \App\Models\Diary::badgeClasses($event->event_type) }}">
                                    <span class="uppercase truncate">{{ $event->event_type }}</span>
                                    <span class="uppercase">{{ Carbon::parse($event->event_time)->format('g:iA') }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    {{-- Add Event modal --}}
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-gray-900/50" wire:click.self="closeModal">
            <div class="w-full max-w-md p-6 bg-white shadow-xl rounded-2xl">
                <h2 class="mb-4 text-lg font-semibold text-gray-900">Add event</h2>

                <div class="space-y-4">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Event name</label>
                        <select wire:model="newEventType"
                            class="w-full px-3 py-2 text-sm text-gray-700 border border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                            <option value="">Select an event type</option>
                            <option value="Viewing">Viewing</option>
                            <option value="Take-on">Take-on</option>
                            <option value="Miscellaneous">Miscellaneous</option>
                        </select>
                        @error('newEventType')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Assign to</label>
                        <select wire:model="newAssignedTo"
                            class="w-full px-3 py-2 text-sm text-gray-700 border border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                            <option value="">Select a member</option>
                            @foreach ($this->members as $name)
                                <option value="{{ $name }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('newAssignedTo')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Date</label>
                            <input type="date" wire:model="newEventDate"
                                class="w-full px-3 py-2 text-sm text-gray-700 border border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                            @error('newEventDate')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Time</label>
                            <input type="time" wire:model="newEventTime"
                                class="w-full px-3 py-2 text-sm text-gray-700 border border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                            @error('newEventTime')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Notes</label>
                            <textarea wire:model="newNotes" rows="3"
                                placeholder="Add any additional details..."
                                class="w-full px-3 py-2 text-sm text-gray-700 border border-gray-200 rounded-lg resize-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"></textarea>
                            @error('newNotes')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" wire:click="closeModal"
                        class="px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100">
                        Cancel
                    </button>
                    <button type="button" wire:click="save"
                        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                        Save event
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>