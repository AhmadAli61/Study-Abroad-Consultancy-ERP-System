<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Session\Middleware\StartSession;
use App\Http\Middleware\HtmlMinifyMiddleware;
use App\Console\Commands\CleanupOldIntakes;
use App\Console\Commands\LogoutAllUsers; // ✅ Add your LogoutAllUsers command here

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->use([
            StartSession::class,
            HtmlMinifyMiddleware::class,
            \App\Http\Middleware\ManageDatabaseConnections::class, // ✅ DB cleanup middleware
        ]);

        // Route Middleware aliases
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'manager' => \App\Http\Middleware\ManagerMiddleware::class,
            'counsellor' => \App\Http\Middleware\CounsellorMiddleware::class,
            'admission' => \App\Http\Middleware\AdmissionMiddleware::class,
            'admissionagent' => \App\Http\Middleware\AdmissionAgentMiddleware::class,
            'externalagent' => \App\Http\Middleware\ExternalAgentMiddleware::class,
            'viewonly' => \App\Http\Middleware\CheckViewOnly::class,
        ]);
    })
    ->withCommands([
        CleanupOldIntakes::class,
        LogoutAllUsers::class, // ✅ Register the new command
    ])
    ->withSchedule(function (Schedule $schedule) {
        // ✅ Schedule LogoutAllUsers to run daily at midnight
        $schedule->command('users:logout')->dailyAt('00:00');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
