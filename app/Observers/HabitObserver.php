<?php

namespace App\Observers;

use App\Models\Habit;

class HabitObserver
{
    /**
     * Handle the Habit "created" event.
     */
    public function created(Habit $habit): void
    {
        $habit->days()->create();
    }

    /**
     * Handle the Habit "updated" event.
     */
    public function updated(Habit $habit): void
    {
        //
    }

    /**
     * Handle the Habit "deleted" event.
     */
    public function deleted(Habit $habit): void
    {
        //
    }

    /**
     * Handle the Habit "restored" event.
     */
    public function restored(Habit $habit): void
    {
        //
    }

    /**
     * Handle the Habit "force deleted" event.
     */
    public function forceDeleted(Habit $habit): void
    {
        //
    }
}
