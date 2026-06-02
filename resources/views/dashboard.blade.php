<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <main class="p-6 space-y-6 sm:p-10">
      <section class="grid gap-6 md:grid-cols-4 xl:grid-cols-4">
        <div class="flex items-center p-8 bg-white rounded-lg shadow">
          <div class="inline-flex items-center justify-center flex-shrink-0 w-16 h-16 mr-6 text-blue-600 bg-blue-100 rounded-full">
            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>
          </div>
          <div>
            <span class="block text-2xl font-bold">645</span>
            <span class="block text-gray-500">Total Leads (2022 - 2024)</span>
          </div>
        </div>
        <div class="flex items-center p-8 bg-white rounded-lg shadow">
          <div class="inline-flex items-center justify-center flex-shrink-0 w-16 h-16 mr-6 text-green-600 bg-green-100 rounded-full">
            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>
          </div>
          <div>
            <span class="block text-2xl font-bold">7</span>
            <span class="block text-gray-500">Total Sales (2026)</span>
          </div>
        </div>
        <div class="flex items-center p-8 bg-white rounded-lg shadow">
          <div class="inline-flex items-center justify-center flex-shrink-0 w-16 h-16 mr-6 text-red-600 bg-red-100 rounded-full">
            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
            </svg>
          </div>
          <div>
            <span class="inline-block text-2xl font-bold">2</span>
            <span class="block text-gray-500">Pending Requirements</span>
          </div>
        </div>
        <div class="flex items-center p-8 bg-white rounded-lg shadow">
          <div class="inline-flex items-center justify-center flex-shrink-0 w-16 h-16 mr-6 text-blue-600 bg-blue-100 rounded-full">
            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
          </div>
          <div>
            <span class="block text-2xl font-bold">7</span>
            <span class="block text-gray-500">Total Viewing</span>
          </div>
        </div>
      </section>

      <section class="grid gap-6 md:grid-cols-2 xl:grid-cols-4 xl:grid-rows-3 xl:grid-flow-col">
        <div class="flex flex-col bg-white rounded-lg shadow md:col-span-2 md:row-span-2">
          <div class="px-6 py-5 font-semibold border-b border-gray-100">
            <h1 style="font-size:22px; font-weight:700; color:#111827;" id="month-title"></h1>
        </div>
          <div class="flex-grow p-4">
            
        <div class="">
        {{-- Top bar --}}
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">


            <div style="display:flex; align-items:center; gap:8px;">
                {{-- Month view label --}}
                <div style="display:flex; align-items:center; gap:4px; border:1px solid #d1d5db; border-radius:8px; padding:8px 12px; font-size:13px; font-weight:500; color:#374151; cursor:default; user-select:none;">
                    Month view
                    <svg width="14" height="14" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>

                <div style="width:1px; height:24px; background:#d1d5db;"></div>

                {{-- Add event --}}
                <button onclick="openAddModal(null)"
                    style="display:flex; align-items:center; gap:6px; background:#255A8A; color:#fff; border:none; border-radius:8px; padding:8px 16px; font-size:13px; font-weight:600; cursor:pointer;"
                    onmouseenter="this.style.background='#255A8A'" onmouseleave="this.style.background='#255A8A'">
                    Add event
                </button>
            </div>
        </div>

        {{-- Calendar --}}
        <div style="border:1px solid #d1d5db; border-radius:8px; overflow:hidden; background:#fff;">

            {{-- Day headers --}}
            <div style="display:grid; grid-template-columns:repeat(7,1fr); border-bottom:1px solid #d1d5db; background:#fff;">
                @foreach(['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] as $d)
                <div style="padding:10px 0; text-align:center; font-size:12px; font-weight:600; color:#6b7280;
                    {{ !$loop->last ? 'border-right:1px solid #d1d5db;' : '' }}">
                    {{ $d }}
                </div>
                @endforeach
            </div>

            {{-- Grid cells (filled by JS) --}}
            <div id="cal-grid" style="display:grid; grid-template-columns:repeat(7,1fr);"></div>
        </div>

    </div>

    {{-- Modal --}}
    <div id="modal-overlay"
        style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); z-index:50; align-items:center; justify-content:center;"
        onclick="handleOverlayClick(event)">
        <div style="background:#fff; border-radius:12px; box-shadow:0 20px 40px rgba(0,0,0,0.15); width:100%; max-width:420px; margin:0 16px; padding:24px;"
            onclick="event.stopPropagation()">

            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:20px;">
                <span style="font-size:15px; font-weight:600; color:#111827;" id="modal-heading">Add event</span>
                <button onclick="closeModal()" style="background:none; border:none; cursor:pointer; color:#9ca3af; padding:2px;"
                    onmouseenter="this.style.color='#374151'" onmouseleave="this.style.color='#9ca3af'">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div style="display:flex; flex-direction:column; gap:14px;">
                <div>
                    <label style="display:block; font-size:13px; color:#6b7280; margin-bottom:4px;">Event title</label>
                    <input id="ev-title" type="text" placeholder="e.g. Team standup"
                        style="width:100%; border:1px solid #d1d5db; border-radius:8px; padding:8px 12px; font-size:14px; outline:none; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#255A8A'; this.style.boxShadow='0 0 0 3px rgba(79,70,229,0.15)'"
                        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none'"/>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div>
                        <label style="display:block; font-size:13px; color:#6b7280; margin-bottom:4px;">Date</label>
                        <input id="ev-date" type="date"
                            style="width:100%; border:1px solid #d1d5db; border-radius:8px; padding:8px 12px; font-size:14px; outline:none; box-sizing:border-box;"
                            onfocus="this.style.borderColor='#255A8A'" onblur="this.style.borderColor='#d1d5db'"/>
                    </div>
                    <div>
                        <label style="display:block; font-size:13px; color:#6b7280; margin-bottom:4px;">Time</label>
                        <input id="ev-time" type="time"
                            style="width:100%; border:1px solid #d1d5db; border-radius:8px; padding:8px 12px; font-size:14px; outline:none; box-sizing:border-box;"
                            onfocus="this.style.borderColor='#255A8A'" onblur="this.style.borderColor='#d1d5db'"/>
                    </div>
                </div>
                <div>
                    <label style="display:block; font-size:13px; color:#6b7280; margin-bottom:4px;">Notes</label>
                    <textarea id="ev-notes" rows="3" placeholder="Optional details..."
                        style="width:100%; border:1px solid #d1d5db; border-radius:8px; padding:8px 12px; font-size:14px; outline:none; resize:none; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#255A8A'" onblur="this.style.borderColor='#d1d5db'"></textarea>
                </div>
            </div>

            <div style="display:flex; align-items:center; justify-content:space-between; margin-top:20px;">
                <button id="btn-delete" onclick="deleteEvent()"
                    style="display:none; background:none; border:none; font-size:13px; font-weight:500; color:#ef4444; cursor:pointer;"
                    onmouseenter="this.style.color='#b91c1c'" onmouseleave="this.style.color='#ef4444'">
                    Delete event
                </button>
                <div style="display:flex; gap:8px; margin-left:auto;">
                    <button onclick="closeModal()"
                        style="padding:8px 16px; font-size:13px; font-weight:500; color:#374151; border:1px solid #d1d5db; border-radius:8px; background:transparent; cursor:pointer;"
                        onmouseenter="this.style.background='#f3f4f6'" onmouseleave="this.style.background='transparent'">
                        Cancel
                    </button>
                    <button onclick="saveEvent()"
                        style="padding:8px 16px; font-size:13px; font-weight:600; color:#fff; background:#255A8A; border:none; border-radius:8px; cursor:pointer;"
                        onmouseenter="this.style.background='#255A8A'" onmouseleave="this.style.background='#255A8A'">
                        Save event
                    </button>
                </div>
            </div>
        </div>
    </div><!--calendar widget-->
          </div>
        </div>

        <div class="flex items-center p-8 bg-white rounded-lg shadow">
          <div class="inline-flex items-center justify-center flex-shrink-0 w-16 h-16 mr-6 text-yellow-600 bg-yellow-100 rounded-full">
            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
              <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
              <path fill="#fff" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
            </svg>
          </div>
          <div>
            <span class="block text-2xl font-bold">This is a chart</span>
          </div>
        </div>
      </section>
    </main>

    <script>
        let currentDate = new Date();
        let editingId   = null;
        let nextId      = 100;

        const pad = n => String(n).padStart(2, '0');

        // Build dates for current month's 10th, 20th, 25th
        function makeDate(day) {
            const d = new Date();
            return d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(day);
        }

        let events = [
            { id:1, title:'Miscellaneous',  date: makeDate(10), time:'10:00', notes:'', color:'#93c5fd', textColor:'#1e3a5f' },
            { id:2, title:'Viewing',        date: makeDate(20), time:'01:00', notes:'', color:'#86efac', textColor:'#14532d' },
            { id:3, title:'Take-on', date: makeDate(25), time:'10:30', notes:'', color:'#fbcfe8', textColor:'#831843' },
        ];

        function fmtDate(d) {
            const x = new Date(d);
            return x.getFullYear() + '-' + pad(x.getMonth() + 1) + '-' + pad(x.getDate());
        }

        function fmtTime(t) {
            if (!t) return '';
            const [h, m] = t.split(':');
            const hr = parseInt(h);
            return (hr % 12 || 12) + (m !== '00' ? ':' + m : '') + (hr < 12 ? 'AM' : 'PM');
        }

        function getEventsForDate(ds) {
            return events.filter(e => e.date === ds).sort((a, b) => (a.time || '').localeCompare(b.time || ''));
        }

        function renderCalendar() {
            const y = currentDate.getFullYear();
            const m = currentDate.getMonth();
            const names = ['January','February','March','April','May','June',
                           'July','August','September','October','November','December'];
            document.getElementById('month-title').textContent = names[m] + ' ' + y;

            const grid = document.getElementById('cal-grid');
            grid.innerHTML = '';

            let firstDay = new Date(y, m, 1).getDay();
            firstDay = firstDay === 0 ? 6 : firstDay - 1;

            const daysInMonth = new Date(y, m + 1, 0).getDate();
            const daysInPrev  = new Date(y, m, 0).getDate();
            const todayStr    = fmtDate(new Date());
            const total       = Math.ceil((firstDay + daysInMonth) / 7) * 7;
            const weeks       = total / 7;

            for (let i = 0; i < total; i++) {
                let day, dateStr, isOther = false;
                if (i < firstDay) {
                    day = daysInPrev - firstDay + i + 1;
                    dateStr = fmtDate(new Date(y, m - 1, day));
                    isOther = true;
                } else if (i >= firstDay + daysInMonth) {
                    day = i - firstDay - daysInMonth + 1;
                    dateStr = fmtDate(new Date(y, m + 1, day));
                    isOther = true;
                } else {
                    day = i - firstDay + 1;
                    dateStr = fmtDate(new Date(y, m, day));
                }

                const isToday   = dateStr === todayStr;
                const cellEvs   = getEventsForDate(dateStr);
                const isLastRow = Math.floor(i / 7) === weeks - 1;
                const isLastCol = i % 7 === 6;

                const cell = document.createElement('div');
                cell.style.cssText =
                    'min-height:110px; padding:10px 12px; cursor:pointer; background:#fff; transition:background 0.1s;'
                    + (!isLastRow ? 'border-bottom:1px solid #d1d5db;' : '')
                    + (!isLastCol ? 'border-right:1px solid #d1d5db;' : '');
                cell.onmouseenter = () => cell.style.background = '#f9fafb';
                cell.onmouseleave = () => cell.style.background = '#fff';
                cell.onclick = () => openAddModal(dateStr);

                // Day number
                const dayWrap = document.createElement('div');
                dayWrap.style.marginBottom = '6px';
                if (isToday) {
                    dayWrap.innerHTML = '<span style="display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:50%;background:#4f46e5;color:#fff;font-size:13px;font-weight:700;">' + day + '</span>';
                } else {
                    dayWrap.innerHTML = '<span style="font-size:13px;font-weight:500;color:' + (isOther ? '#d1d5db' : '#374151') + ';">' + day + '</span>';
                }
                cell.appendChild(dayWrap);

                // Event pills
                cellEvs.slice(0, 3).forEach(function(ev) {
                    const row = document.createElement('div');
                    row.style.cssText = 'display:flex;align-items:center;justify-content:space-between;'
                        + 'font-size:12px;font-weight:500;padding:2px 7px;margin-bottom:3px;'
                        + 'border-radius:4px;cursor:pointer;gap:6px;'
                        + 'background:' + (ev.color || '#e0e7ff') + ';'
                        + 'color:' + (ev.textColor || '#255A8A') + ';';
                    const titleSpan = document.createElement('span');
                    titleSpan.style.cssText = 'overflow:hidden;text-overflow:ellipsis;white-space:nowrap;';
                    titleSpan.textContent = ev.title;
                    row.appendChild(titleSpan);
                    if (ev.time) {
                        const timeSpan = document.createElement('span');
                        timeSpan.style.cssText = 'white-space:nowrap;font-size:11px;flex-shrink:0;opacity:0.75;';
                        timeSpan.textContent = fmtTime(ev.time);
                        row.appendChild(timeSpan);
                    }
                    row.onclick = function(e) { e.stopPropagation(); openEditModal(ev.id); };
                    cell.appendChild(row);
                });

                if (cellEvs.length > 3) {
                    const more = document.createElement('div');
                    more.style.cssText = 'font-size:11px;color:#9ca3af;margin-top:2px;';
                    more.textContent = '+' + (cellEvs.length - 3) + ' more';
                    cell.appendChild(more);
                }

                grid.appendChild(cell);
            }
        }

        function openAddModal(dateStr) {
            editingId = null;
            document.getElementById('modal-heading').textContent = 'Add event';
            document.getElementById('btn-delete').style.display = 'none';
            document.getElementById('ev-title').value = '';
            document.getElementById('ev-date').value  = dateStr || fmtDate(new Date());
            document.getElementById('ev-time').value  = '';
            document.getElementById('ev-notes').value = '';
            const overlay = document.getElementById('modal-overlay');
            overlay.style.display = 'flex';
            setTimeout(function() { document.getElementById('ev-title').focus(); }, 50);
        }

        function openEditModal(id) {
            const ev = events.find(function(e) { return e.id === id; });
            if (!ev) return;
            editingId = id;
            document.getElementById('modal-heading').textContent = 'Edit event';
            document.getElementById('btn-delete').style.display = 'block';
            document.getElementById('ev-title').value = ev.title;
            document.getElementById('ev-date').value  = ev.date;
            document.getElementById('ev-time').value  = ev.time || '';
            document.getElementById('ev-notes').value = ev.notes || '';
            document.getElementById('modal-overlay').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('modal-overlay').style.display = 'none';
            editingId = null;
        }

        function handleOverlayClick(e) {
            if (e.target.id === 'modal-overlay') closeModal();
        }

        function saveEvent() {
            const title = document.getElementById('ev-title').value.trim();
            if (!title) { document.getElementById('ev-title').focus(); return; }
            const date  = document.getElementById('ev-date').value;
            const time  = document.getElementById('ev-time').value;
            const notes = document.getElementById('ev-notes').value;
            if (editingId !== null) {
                const ev = events.find(function(e) { return e.id === editingId; });
                if (ev) { ev.title = title; ev.date = date; ev.time = time; ev.notes = notes; }
            } else {
                events.push({ id: nextId++, title: title, date: date, time: time, notes: notes, color: '#e0e7ff', textColor: '#3730a3' });
            }
            closeModal();
            renderCalendar();
        }

        function deleteEvent() {
            if (editingId === null) return;
            events = events.filter(function(e) { return e.id !== editingId; });
            closeModal();
            renderCalendar();
        }

        function changeMonth(dir) {
            currentDate.setMonth(currentDate.getMonth() + dir);
            renderCalendar();
        }

        function goToday() {
            currentDate = new Date();
            renderCalendar();
        }

        renderCalendar();
    </script>
</x-app-layout>
