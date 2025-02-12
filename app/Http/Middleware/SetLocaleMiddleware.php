<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();

        // Определяем язык по домену
        $locale = match (true) {
            str_ends_with($host, '.ru') => 'ru',
            default => 'en',
        };

        Session::put('locale', $locale);
        App::setLocale($locale);
        
        return $next($request);
    }
}
