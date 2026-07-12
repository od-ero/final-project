<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeocodingService
{
    /**
     * Reverse geocode coordinates to a human-readable address.
     *
     * @param float|string $latitude
     * @param float|string $longitude
     * @return string|null
     */
    public function reverseGeocode($latitude, $longitude): ?string
    {
        if (empty($latitude) || empty($longitude)) {
            return null;
        }

        try {
            $response = Http::withHeaders([
                'User-Agent' => config('app.name', 'Laravel') . '/1.0',
            ])
                ->acceptJson()
                ->timeout(5)
                ->retry(2, 500)
                ->get('https://nominatim.openstreetmap.org/reverse', [
                    'format' => 'jsonv2',
                    'lat'    => $latitude,
                    'lon'    => $longitude,
                ]);

            if (! $response->successful()) {
                Log::warning('Reverse geocoding failed.', [
                    'latitude'  => $latitude,
                    'longitude' => $longitude,
                    'status'    => $response->status(),
                    'response'  => $response->body(),
                ]);

                return null;
            }

            return $response->json('display_name');
        } catch (\Throwable $e) {
            Log::error('Reverse geocoding exception.', [
                'latitude'  => $latitude,
                'longitude' => $longitude,
                'message'   => $e->getMessage(),
            ]);

            return null;
        }
    }
}
