<?php

namespace App\Livewire;

use App\Models\Habit;
use App\Models\HabitDay;
use Livewire\Component;

class HabitDays extends Component
{
    public function dayCheck($day, $habitId): void
    {
        Habit::find($habitId)->days()->whereDay('created_at', $day)->firstOrCreate([
            'created_at' => now()->day($day),
        ])->toggleDay();
    }

    public function render()
    {
        return view('livewire.habit-days', [
            'habits' => Habit::all(),
            'dones' => HabitDay::dones()
                                ->get()
                                ->groupBy(fn ($item) => $item->created_at->day)
                                ->map(fn($items) => $items->count()),
            'fails' => HabitDay::fails()
                                ->get()
                                ->groupBy(fn ($item) => $item->created_at->day)
                                ->map(fn($items) => $items->count()),
            'days' => range(1, now()->daysInMonth()),
        ]);
    }
}
