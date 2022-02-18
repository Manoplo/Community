<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Obtengo el idioma del navegador mediante el header Accept-Language y sustraigo las dos primeras letras. 
        $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

        // Con el método estático setLocale puedo definir el idioma de mi app mirando al es.json del dir lang. 
        if ($locale !== 'es' || $locale !== 'es') {
            App::setLocale('en');
        } else {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
