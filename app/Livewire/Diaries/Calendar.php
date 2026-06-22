<?php

namespace App\Livewire\Diaries;

use App\Models\Diary;
use App\Notifications\DiaryEventAssigned;
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
    // Filters
    public string $period = '';       // e.g. "2026-06", bound to the Month dropdown
    public string $selectedMember = ''; // currently viewed member's name

    // Modal + form state
    public bool $showModal = false;
    public string $newEventType = '';
    public string $newAssignedTo = '';
    public string $newEventDate = '';
    public string $newEventTime = '';
    public string $newNotes = '';

    public function mount(): void
    {
        $this->period = now()->format('Y-m');

        $members = $this->memberNames();
        $loggedInFirstName = auth()->check() ? Str::before(auth()->user()->name, ' ') : null;

        $this->selectedMember = in_array($loggedInFirstName, $members, true)
            ? $loggedInFirstName
            : ($members[0] ?? '');
    }

    /**
     * All member names, in the order defined in config/team.php.
     */
    protected function memberNames(): array
    {
        return array_keys(config('team.members', []));
    }

    #[Computed]
    public function members(): array
    {
        return $this->memberNames();
    }

    /**
     * Month dropdown options: January of this year through December of next year.
     */
    #[Computed]
    public function monthOptions(): array
    {
        $options = [];
        $cursor = Carbon::create(now()->year, 1, 1);
        $end = Carbon::create(now()->year + 1, 12, 1);

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

    /**
     * The full grid of weeks to render, Monday-first, including the
     * trailing/leading days from adjacent months that fill out the grid.
     */
    #[Computed]
    public function calendarWeeks(): array
    {
        $monthStart = $this->periodDate();
        $gridStart = $monthStart->copy()->startOfWeek(Carbon::MONDAY);
        $gridEnd = $monthStart->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

        $events = Diary::where('assigned_to', $this->selectedMember)
            ->whereBetween('event_date', [$gridStart->format('Y-m-d'), $gridEnd->format('Y-m-d')])
            ->orderBy('event_time')
            ->get()
            ->groupBy(fn (Diary $diary) => $diary->event_date->format('Y-m-d'));

        $weeks = [];
        $week = [];
        $cursor = $gridStart->copy();

        while ($cursor->lte($gridEnd)) {
            $key = $cursor->format('Y-m-d');

            $week[] = [
                'date' => $cursor->copy(),
                'inMonth' => $cursor->month === $monthStart->month,
                'isToday' => $cursor->isToday(),
                'events' => $events->get($key, collect()),
            ];

            if ($cursor->dayOfWeekIso === 7) {
                $weeks[] = $week;
                $week = [];
            }

            $cursor->addDay();
        }

        return $weeks;
    }

    public function openModal(): void
    {
        $this->resetForm();
        $this->newEventDate = $this->periodDate()->format('Y-m-d');
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
    }

    protected function resetForm(): void
    {
        $this->reset(['newEventType', 'newAssignedTo', 'newEventDate', 'newEventTime', 'newNotes']);
        $this->resetErrorBag();
    }

    protected function rules(): array
    {
        return [
            'newEventType' => ['required', Rule::in(['Viewing', 'Take-on', 'Miscellaneous'])],
            'newAssignedTo' => ['required', Rule::in($this->memberNames())],
            'newEventDate' => ['required', 'date'],
            'newEventTime' => ['required'],
        ];
    }

    public function save(): void
    {
        $this->validate();

        $diary = Diary::create([
            'event_type' => $this->newEventType,
            'assigned_to' => $this->newAssignedTo,
            'event_date' => $this->newEventDate,
            'event_time' => $this->newEventTime,
            'notes'      => $this->newNotes,
            'created_by' => auth()->id(),
        ]);

        $email = config('team.members')[$diary->assigned_to] ?? null;

        if ($email) {
            Notification::route('mail', $email)->notify(new DiaryEventAssigned($diary));
        }

        $this->showModal = false;
        $this->resetForm();

        session()->flash('status', "Event saved — {$diary->assigned_to} has been notified.");
    }

    public function render()
    {
        return view('diaries.calendar');
    }
}