<?php

use Livewire\Component;
use App\Models\Habit;

new class extends Component
{
    public $habits = [];

    public function mount(): void
    {
        $this->habits = Habit::all();
    }
};
?>

<div class="mx-2">
    <flux:table>
        <flux:table.columns>
            <flux:table.row rowspan="1">&nbsp;</flux:table.row>
            <flux:table.column align="center">{{ __('My habits') }}</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($habits as $habit)
            <flux:table.row :key="$habit->id">
                <flux:table.cell align="center">{{ $habit->name }}&nbsp;{!! $habit->icon !!}</flux:table.cell>
            </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>