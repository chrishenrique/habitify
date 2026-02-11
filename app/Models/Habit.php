<?php

namespace App\Models;

use App\Observers\HabitObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([HabitObserver::class])]
class Habit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
    ];

    public function days(): HasMany
    {
        return $this->hasMany(HabitDay::class);
    }

    public function progress(): float
    {
        return $this->days()->dones()->count() / now()->daysInMonth();
    }

    public function day($day): bool
    {
        return $this->days()->whereDay('created_at', $day)->first()?->is_done ?? false;
    }
}
