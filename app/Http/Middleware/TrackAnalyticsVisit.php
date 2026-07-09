<?php

namespace App\Http\Middleware;

use App\Models\AnalyticsVisit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class TrackAnalyticsVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldTrack($request, $response)) {
            try {
                AnalyticsVisit::create([
                    'visited_at' => now(),
                    'path' => '/' . ltrim($request->path(), '/'),
                    'full_url' => $request->fullUrl(),
                    'route_name' => $request->route()?->getName(),
                    'locale' => $this->detectLocale($request),
                    'method' => $request->method(),
                    'referrer' => str($request->headers->get('referer'))->limit(255)->toString(),
                    'utm_source' => str($request->query('utm_source'))->limit(255)->toString() ?: null,
                    'utm_medium' => str($request->query('utm_medium'))->limit(255)->toString() ?: null,
                    'utm_campaign' => str($request->query('utm_campaign'))->limit(255)->toString() ?: null,
                    'device' => $this->detectDevice($request->userAgent()),
                    'browser' => $this->detectBrowser($request->userAgent()),
                    'ip_hash' => hash('sha256', ($request->ip() ?? 'unknown') . '|' . config('app.key')),
                    'session_hash' => $request->hasSession() ? hash('sha256', $request->session()->getId() . '|' . config('app.key')) : null,
                    'user_agent' => str($request->userAgent())->limit(1000)->toString(),
                ]);
            } catch (\Throwable) {
                // Analytics must never break public page rendering.
            }
        }

        return $response;
    }

    private function shouldTrack(Request $request, Response $response): bool
    {
        if (!$request->isMethod('GET') || !$response->isSuccessful()) {
            return false;
        }

        if (!Schema::hasTable('analytics_visits')) {
            return false;
        }

        if ($request->is('admin*', 'up', 'storage/*', 'images/*', 'assets/*', 'admin-assets/*', 'build/*')) {
            return false;
        }

        $path = $request->path();

        return !preg_match('/\.(css|js|png|jpe?g|webp|gif|svg|ico|mp4|webm|woff2?|ttf|map)$/i', $path);
    }

    private function detectLocale(Request $request): string
    {
        $routeName = $request->route()?->getName() ?? '';

        if (str_contains($routeName, '_eng') || str($request->path())->contains('_eng') || $request->is('eng')) {
            return 'en';
        }

        return 'id';
    }

    private function detectDevice(?string $userAgent): string
    {
        $ua = strtolower($userAgent ?? '');

        if (str_contains($ua, 'bot') || str_contains($ua, 'crawl') || str_contains($ua, 'spider')) {
            return 'bot';
        }

        if (str_contains($ua, 'tablet') || str_contains($ua, 'ipad')) {
            return 'tablet';
        }

        if (str_contains($ua, 'mobile') || str_contains($ua, 'android') || str_contains($ua, 'iphone')) {
            return 'mobile';
        }

        return 'desktop';
    }

    private function detectBrowser(?string $userAgent): string
    {
        $ua = strtolower($userAgent ?? '');

        return match (true) {
            str_contains($ua, 'edg/') => 'Edge',
            str_contains($ua, 'chrome/') => 'Chrome',
            str_contains($ua, 'safari/') && !str_contains($ua, 'chrome/') => 'Safari',
            str_contains($ua, 'firefox/') => 'Firefox',
            default => 'Other',
        };
    }
}
