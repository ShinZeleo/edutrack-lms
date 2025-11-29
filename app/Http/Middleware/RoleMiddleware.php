<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        $allowedRoles = collect(explode(',', $role))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values();

        if (!$allowedRoles->contains($user->role)) {
            abort(403, 'Unauthorized access. Role ' . $role . ' required.');
        }

        return $next($request);
    }
}
