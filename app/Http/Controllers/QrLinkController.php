<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QrLinkController extends Controller
{
    public function show(Request $request): View
    {
        $information = Information::first();
        $defaultWebsite = $this->safeHttpUrl($information?->website_link, url('/'));
        $defaultInstagram = 'https://www.instagram.com/arimapestclean/';
        $defaultWhatsapp = 'https://wa.me/'.preg_replace('/\D+/', '', $information?->phone_wa ?: '628113000655');

        $website = $this->safeHttpUrl($request->query('website'), $defaultWebsite);
        $instagram = $this->safeHostUrl(
            $request->query('instagram'),
            ['instagram.com'],
            $defaultInstagram
        );
        $whatsapp = $this->safeHostUrl(
            $request->query('whatsapp'),
            ['wa.me', 'api.whatsapp.com'],
            $defaultWhatsapp
        );

        return view('qr-links.show', compact('information', 'website', 'instagram', 'whatsapp'));
    }

    private function safeHostUrl(?string $value, array $allowedHosts, string $fallback): string
    {
        $url = $this->safeHttpUrl($value, $fallback);
        $host = strtolower((string) parse_url($url, PHP_URL_HOST));

        foreach ($allowedHosts as $allowedHost) {
            if ($host === $allowedHost || str_ends_with($host, '.'.$allowedHost)) {
                return $url;
            }
        }

        return $fallback;
    }

    private function safeHttpUrl(?string $value, string $fallback): string
    {
        if (! is_string($value) || ! filter_var($value, FILTER_VALIDATE_URL)) {
            return $fallback;
        }

        $scheme = strtolower((string) parse_url($value, PHP_URL_SCHEME));

        return in_array($scheme, ['http', 'https'], true) ? $value : $fallback;
    }
}
