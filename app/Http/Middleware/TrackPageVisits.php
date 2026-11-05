<?php

namespace App\Http\Middleware;

use App\Models\PageVisit;
use Closure;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class TrackPageVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (
            $request->isMethod('get') &&
            !$request->is('admin/*') &&
            !$request->ajax() &&
            !$request->expectsJson()
        ) {
            $this->trackVisit($request);
        }

        return $response;
    }

    private function trackVisit(Request $request)
    {
        $agent = new Agent();

        $ip = $request->ip();

        // Valeurs par défaut
        $country = 'Inconnu';
        $city = 'Inconnu';

        // Éviter les requêtes inutiles pour localhost / IP privées
        if ($ip && filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {

            try {
                $geo = Http::timeout(2)
                    ->get("http://ip-api.com/json/{$ip}", [
                        'fields' => 'country,city',
                    ])
                    ->json();

                $country = $geo['country'] ?? 'Inconnu';
                $city = $geo['city'] ?? 'Inconnu';

            } catch (\Throwable $e) {
                // On ne bloque jamais la navigation si la géolocalisation échoue
            }
        }

        PageVisit::create([
            'url' => $request->fullUrl(),
            'ip_address' => $ip,
            'country' => $country,
            'city' => $city,
            'device' => $agent->device(),
            'browser' => $agent->browser(),
            'platform' => $agent->platform(),
            'referrer' => $request->headers->get('referer'),
            'visited_at' => now(),
        ]);

    }
}
