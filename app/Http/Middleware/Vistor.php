<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Vistor as VistorModel;

class Vistor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = hash('sha512', $request->ip());
        if (!VistorModel::query()->where('ip', $ip)->where('date', today())->exists())
        {
            VistorModel::create(['ip' => $ip,'date' => today()]);
        }

        return $next($request);
    }
}
