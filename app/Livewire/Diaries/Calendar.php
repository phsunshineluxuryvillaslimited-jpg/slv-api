<?php

namespace App\Livewire\Diaries; 

use App\Models\Diary;
use App\Notifications\DiaryEventAssigned;
use App\Notifications\DiaryEventDeleted;
use App\Notifications\DiaryEventUpdated;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Calendar extends Component
{
    // ── Filters ────────────────────────────────────────────────────────────
    public string $period = '';
    public string $selectedMember = '';

    // ── Add-event modal ────────────────────────────────────────────────────
    public bool   $showModal     = false;
    public string $newEventType  = '';
    public string $newAssignedTo = '';
    public string $newEventDate  = '';
    public string $newEventTime  = '';
    public string $newNotes      = '';

    // ── View/Edit modal ────────────────────────────────────────────────────
    public bool   $showViewModal  = false;
    public bool   $editMode       = false;
    public ?int   $viewingEventId = null;
    public string $editEventType  = '';
    public string $editAssignedTo = '';
    public string $editEventDate  = '';
    public string $editEventTime  = '';
    public string $editNotes      = '';

    // ── Boot ───────────────────────────────────────────────────────────────
    public function mount(): void
    {
        $this->period = now()->format('Y-m');

        $members       = $this->memberNames();
        $loggedInFirst = auth()->check() ? Str::before(auth()->user()->name, ' ') : null;
        $this->selectedMember = in_array($loggedInFirst, $members, true)
            ? $loggedInFirst
            : ($members[0] ?? '');
    }

    // ── Helpers ────────────────────────────────────────────────────────────
    protected function memberNames(): array
    {
        return array_keys(config('team.members', []));
    }

    #[Computed]
    public function members(): array
    {
        return $this->memberNames();
    }

    #[Computed]
    public function monthOptions(): array
    {
        $options = [];
        $cursor  = Carbon::create(now()->year, 1, 1);
        $end     = Carbon::create(now()->year + 1, 12, 1);

        while ($cursor->lte($end)) {
            $options[] = [
                'value' => $cursor->format('Y-m'),
                'label' => $cursor->format('F Y'),
            ];
            $cursor->addMonth();
        }

        return $options;
    }

    protected function periodDate(): Carbon
    {
        return Carbon::createFromFormat('Y-m', $this->period)->startOfMonth();
    }

    #[Computed]
    public function calendarWeeks(): array
    {
        $monthStart = $this->periodDate();
        $gridStart  = $monthStart->copy()->startOfWeek(Carbon::MONDAY);
        $gridEnd    = $monthStart->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

        $events = Diary::where('assigned_to', $this->selectedMember)
            ->whereBetween('event_date', [$gridStart->format('Y-m-d'), $gridEnd->format('Y-m-d')])
            ->orderBy('event_time')
            ->get()
            ->groupBy(fn (Diary $diary) => $diary->event_date->format('Y-m-d'));

        $weeks  = [];
        $week   = [];
        $cursor = $gridStart->copy();

        while ($cursor->lte($gridEnd)) {
            $key    = $cursor->format('Y-m-d');
            $week[] = [
                'date'    => $cursor->copy(),
                'inMonth' => $cursor->month === $monthStart->month,
                'isToday' => $cursor->isToday(),
                'events'  => $events->get($key, collect()),
            ];

            if ($cursor->dayOfWeekIso === 7) {
                $weeks[] = $week;
                $week    = [];
            }

            $cursor->addDay();
        }

        return $weeks;
    }

    // ── Add-event modal ────────────────────────────────────────────────────
    public function openModal(): void
    {
        $this->resetAddForm();
        $this->newEventDate = $this->periodDate()->format('Y-m-d');
        $this->showModal    = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetAddForm();
    }

    protected function resetAddForm(): void
    {
        $this->reset(['newEventType', 'newAssignedTo', 'newEventDate', 'newEventTime', 'newNotes']);
        $this->resetErrorBag();
    }

    public function save(): void
    {
        $this->validate([
            'newEventType'  => ['required', Rule::in(['Viewing', 'Take-on', 'Miscellaneous'])],
            'newAssignedTo' => ['required', Rule::in($this->memberNames())],
            'newEventDate'  => ['required', 'date'],
            'newEventTime'  => ['required'],
        ]);

        $diary = Diary::create([
            'event_type'  => $this->newEventType,
            'assigned_to' => $this->newAssignedTo,
            'event_date'  => $this->newEventDate,
            'event_time'  => $this->newEventTime,
            'notes'       => $this->newNotes,
            'created_by'  => auth()->id(),
        ]);

        $email = config('team.members')[$diary->assigned_to] ?? null;
        if ($email) {
            Notification::route('mail', $email)->notify(new DiaryEventAssigned($diary));
        }

        $this->showModal = false;
        $this->resetAddForm();
        session()->flash('status', "Event saved — {$diary->assigned_to} has been notified.");
    }

    // ── View/Edit/Delete modal ─────────────────────────────────────────────
    public function viewEvent(int $id): void
    {
        $event = Diary::findOrFail($id);

        $this->viewingEventId = $id;
        $this->editEventType  = $event->event_type;
        $this->editAssignedTo = $event->assigned_to;
        $this->editEventDate  = $event->event_date->format('Y-m-d');
        $this->editEventTime  = $event->event_time;
        $this->editNotes      = $event->notes ?? '';
        $this->editMode       = false;
        $this->showViewModal  = true;
        $this->resetErrorBag();
    }

    public function enableEdit(): void
    {
        $this->editMode = true;
    }

    public function closeViewModal(): void
    {
        $this->showViewModal  = false;
        $this->editMode       = false;
        $this->viewingEventId = null;
        $this->resetErrorBag();
    }

    public function updateEvent(): void
    {
        $this->validate([
            'editEventType'  => ['required', Rule::in(['Viewing', 'Take-on', 'Miscellaneous'])],
            'editAssignedTo' => ['required', Rule::in($this->memberNames())],
            'editEventDate'  => ['required', 'date'],
            'editEventTime'  => ['required'],
        ]);

        $event         = Diary::findOrFail($this->viewingEventId);
        $oldAssignedTo = $event->assigned_to;

        $event->update([
            'event_type'  => $this->editEventType,
            'assigned_to' => $this->editAssignedTo,
            'event_date'  => $this->editEventDate,
            'event_time'  => $this->editEventTime,
            'notes'       => $this->editNotes,
        ]);

        // Notify the (possibly new) assignee.
        $newEmail = config('team.members')[$event->assigned_to] ?? null;
        if ($newEmail) {
            Notification::route('mail', $newEmail)->notify(new DiaryEventUpdated($event));
        }

        // If reassigned, also notify the previous assignee.
        if ($oldAssignedTo !== $event->assigned_to) {
            $oldEmail = config('team.members')[$oldAssignedTo] ?? null;
            if ($oldEmail) {
                Notification::route('mail', $oldEmail)->notify(
                    new DiaryEventDeleted(
                        assignedTo: $oldAssignedTo,
                        eventType:  $event->event_type,
                        eventDate:  $event->event_date->format('F j, Y'),
                        eventTime:  Carbon::parse($event->event_time)->format('g:i A'),
                    )
                );
            }
        }

        $this->closeViewModal();
        session()->flash('status', "Event updated — {$event->assigned_to} has been notified.");
    }

    public function deleteEvent(): void
    {
        $event      = Diary::findOrFail($this->viewingEventId);
        $assignedTo = $event->assigned_to;
        $email      = config('team.members')[$assignedTo] ?? null;

        // Capture display data before the model is deleted.
        $notification = new DiaryEventDeleted(
            assignedTo: $assignedTo,
            eventType:  $event->event_type,
            eventDate:  $event->event_date->format('F j, Y'),
            eventTime:  Carbon::parse($event->event_time)->format('g:i A'),
        );

        $event->delete();

        if ($email) {
            Notification::route('mail', $email)->notify($notification);
        }

        $this->closeViewModal();
        session()->flash('status', "Event deleted — {$assignedTo} has been notified.");
    }

    // ── Render ─────────────────────────────────────────────────────────────
    public function render()
    {
        return view('diaries.calendar');
    }
}