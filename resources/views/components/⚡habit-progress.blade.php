<?php

use Livewire\Component;
use App\Models\Habit;

new class extends Component
{
    public $habits = [];

    public function mount(): void
    {
        $this->habits = Habit::withCount(['days' => fn($query) => $query->dones()])->get();
    }
};
?>

<div class="mx-2">
    <flux:table>
        <flux:table.columns>
            <flux:table.row rowspan="3">
                <div class="text-center">&nbsp;</div>
            </flux:table.row>
            <flux:table.column align="center" class="max-w-15">{{ __('Obj') }}</flux:table.column>
            <flux:table.column align="center" class="max-w-15">{{ __('Actual') }}</flux:table.column>
            <flux:table.column>{{ __('Progress') }}</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($habits as $habit)
            <flux:table.row :key="$habit->id">
                <flux:table.cell align="center">{{ now()->daysInMonth() }}</flux:table.cell>
                <flux:table.cell align="center">{{ $habit->days_count }}</flux:table.cell>
                <flux:table.cell>
                    <div class="mt-1 h-4 w-full bg-zinc-200 rounded-full overflow-hidden">
                        <div class="h-full bg-sky-500 transition-[width]" style="width: {{ $habit->progress() }}%;">
                        </div>
                    </div>
                </flux:table.cell>
            </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>