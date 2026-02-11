<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HabitDay extends Model
{
    public $fillable = ['is_done', 'created_at'];

    public function scopeDones($query, int $month = null, int $year = null)
    {
        $query
            ->whereMonth('created_at', $month ?? now()->month)
            ->whereYear('created_at', $year ?? now()->year)
            ->where('is_done', true);
    }

    public function scopeFails($query, int $month = null, int $year = null)
    {
        $query
            ->whereMonth('created_at', $month ?? now()->month)
            ->whereYear('created_at', $year ?? now()->year)
            ->where('is_done', false);
    }

    public function toggleDay()
    {
        $this->is_done = !$this->is_done;
        $this->save();
    }
}
