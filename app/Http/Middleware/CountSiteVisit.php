<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\SiteVisit;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountSiteVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle($request, Closure $next)
    {
        // Hitung hanya pada GET request biasa
        if ($request->isMethod('get') && !$request->ajax()) {
            // Ambil baris pertama, jika tidak ada, buat
            $visit = SiteVisit::first();
            if (!$visit) {
                SiteVisit::create(['total' => 1]);
            } else {
                $visit->increment('total');
            }
        }

        return $next($request);
    }
}
