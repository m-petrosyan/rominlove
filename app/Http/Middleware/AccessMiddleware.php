<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->query('block')) {
            if ($request->query('block') === 'false') {
                Session::forget('block');
            } else {
                Session::put('block', $request->query('block'));
            }
        }
        if (Session::get('block')) {
            abort(403, Session::get('block'));
        }

        return $next($request);
    }
}
