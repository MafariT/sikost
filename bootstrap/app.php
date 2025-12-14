<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleGate;
use App\Http\Middleware\EnsureRoleAdmin;
use App\Http\Middleware\EnsureUserIsActive;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->validateCsrfTokens(except: [
            '/midtrans/webhook',
        ]);

        $middleware->alias([
            'role'   => RoleGate::class,
            'admin'  => EnsureRoleAdmin::class,
            'active' => EnsureUserIsActive::class,
        ]);

        $middleware->redirectUsersTo(function (Request $request) {
            $user = $request->user();
            if (!$user) {
                return '/';
            }
            return match ($user->role) {
                'admin'   => route('admin.dashboard'),
                'pemilik' => route('pemilik.dashboard'),
                'petugas' => route('petugas.pelaporan.index'),
                'penyewa' => route('penyewa.beranda'),
                default   => route('penyewa.beranda'),
            };
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
