<?php

use App\Exceptions\DocumentMaxPagesCountException;
use App\Models\Document;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('model:prune', [
            '--model' => [Document::class],
        ])->weeklyOn(0, '0:00');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->dontReport(DocumentMaxPagesCountException::class);
    })->create();
