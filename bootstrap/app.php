<?php

use App\Models\Habit;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->call(
            fn () => Habit::each(fn($habit) => $habit->days()->create())
        )->daily();
        $schedule->call(
            fn () => HabitDay::where('is_done', null)
                                ->where('created_at', '<', now())
                                ->update(['is_done', false])
        )->at('23:59');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
