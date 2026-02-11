<?php

use Livewire\Component;
use App\Models\Habit;


new class extends Component
{
    public $habits = [];
    public $totalDones = 0;
    public $progress = 0;

    public function mount() 
    {
        $this->habits = Habit::withCount(['days' => fn($query) => $query->dones()])->get();
        $this->totalDones = $this->habits->sum('days_count');
        $this->progress = round($this->totalDones / ($this->habits->count() * now()->daysInMonth()));
    }
};
?>

<div class="h-full flex justify-around items-center ">
    <div class="">
        <p class="text-xl">{{ now()->format('F') }}</p>
    </div>
    <div class="grid grid-cols-4 gap-5">
        <div class="text-center">{{ __('Habits') }}<br>{{ $habits->count() }}</div>
        <div class="text-center">{{ __('Done') }}<br>{{ $totalDones }}</div>
        <div class="text-center">
            {{ __('Progress') }} {{ $progress }}%
            <div class="mt-1 h-4 w-full bg-zinc-200 rounded-full overflow-hidden">
                <div
                    class="h-full bg-sky-500 transition-[width]"
                    style="width: {{ $progress }}%;"
                >
                </div>
            </div>
            
        </div>
    </div>
</div>