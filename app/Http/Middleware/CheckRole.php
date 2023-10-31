<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();

        if ($user && $user->role === $role) {
            return $next($request);
        }
        return response()->json(['error' => 'Amalyotga huquq yo\'q'], 401);
    }
}
