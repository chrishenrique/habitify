<div class="mx-2" id="habits">
    <flux:table id="habits-table">
        <flux:table.columns>
            @foreach ($days as $day)
            <flux:table.column @class([
                "bg-sky-500/30" => now()->day == $day
            ]) data-day="{{ $day }}">
                <div class="grid grid-cols-1 gap-1 text-center">
                    <div>{{ now()->day($day)->format('D') }}</div>
                    <div>{{ $day }}</div>
                </div>
            </flux:table.column>
            @endforeach
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($habits as $habit)
            <flux:table.row :key="$habit->id">
                @foreach ($days as $day)
                <flux:checkbox.group>
                    <flux:table.cell align="center" @class([
                        'text-center',
                        "bg-sky-500/30" => now()->day == $day
                    ])>
                        <flux:field variant="inline">
                            <flux:checkbox 
                            default="1"
                            :checked="$habit->day($day)"
                            value="{{ $day }}" wire:click='dayCheck({{ $day }}, {{ $habit->id }})'/>
                        </flux:field>
                    </flux:table.cell>
                </flux:checkbox.group>
                @endforeach
            </flux:table.row>
            @endforeach

            <flux:table.row>
                @foreach ($days as $day)
                <flux:table.cell @class([
                    "bg-sky-500/30" => now()->day == $day
                ])>
                    &nbsp;
                </flux:table.cell>
                @endforeach
            </flux:table.row>

            <flux:table.row>
                @foreach ($days as $day)
                <flux:table.cell align="center" @class([
                    "bg-sky-500/30" => now()->day == $day
                ])>
                    <span class="text-[10px]">{{ Arr::get($dones, $day, 0) > 0 ? (Arr::get($dones, $day, 0) + Arr::get($fails, $day, 0)) / Arr::get($dones, $day, 0) : 0 }}%</span>
                </flux:table.cell>
                @endforeach
            </flux:table.row>
            <flux:table.row>
                @foreach ($days as $day)
                <flux:table.cell  align="center" @class([
                    "bg-sky-500/30" => now()->day == $day
                ])>
                    {{ Arr::get($dones, $day, 0) }}
                </flux:table.cell>
                @endforeach
            </flux:table.row>
            <flux:table.row>
                @foreach ($days as $day)
                <flux:table.cell align="center" @class([
                    "bg-sky-500/30" => now()->day == $day
                ])>
                    {{ Arr::get($fails, $day, 0) }}
                </flux:table.cell>
                @endforeach
            </flux:table.row>
            
        </flux:table.rows>
    </flux:table>
</div>

@script
<script>
function scrollByDay(day) {
    const container = document.querySelector('ui-table-scroll-area .overflow-auto');
    
    if (!container) {
        return;
    }

    const maxScrollLeft = container.scrollWidth - container.clientWidth;

    if (day <= 15) {
        container.scrollTo({ left: 0, behavior: 'smooth' });
    } else {
        container.scrollTo({ left: maxScrollLeft, behavior: 'smooth' });
    }
}

scrollByDay("{{ now()->day }}"); 

</script>
@endscript