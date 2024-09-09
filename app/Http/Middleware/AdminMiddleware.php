<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Проверка, является ли пользователь администратором
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            return response()->json(['message' => 'Доступ запрещен'], 403);
        }

        return $next($request);
    }
}
