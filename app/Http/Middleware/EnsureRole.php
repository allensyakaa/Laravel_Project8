<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Pemakaian: ->middleware('role:kasir') atau 'role:kasir,owner'
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login', $roles[0] ?? 'pelanggan');
        }

        if (! in_array($user->role, $roles, true)) {
            return redirect()
                ->route($user->dashboardRoute())
                ->with('error', 'Kamu tidak punya akses ke halaman itu.');
        }

        return $next($request);
    }
}
