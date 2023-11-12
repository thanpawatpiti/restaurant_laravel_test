<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RestaurantLaravelTestController extends Controller
{
    // Fetch data from Google Maps API
    public function search(Request $request)
    {
        // keyword to search
        $keyword = $request->input('query');

        if ($keyword == '') {
            return response()->json([
                'success' => false,
                'message' => 'Keyword is required',
            ]);
        }

        // reset cache data
        // cache()->forget('googlemaps_' . md5($keyword));

        // check cache data
        $cacheKey = 'googlemaps_' . md5($keyword);
        if (cache()->has($cacheKey)) {
            $response = cache()->get($cacheKey);
        } else {
            // Build the URL
            $response = Http::get('https://maps.googleapis.com/maps/api/place/textsearch/json', [
                'query' => $keyword,
                'key' => env('GOOGLE_MAPS_KEY'),
            ]);

            // Convert to JSON
            $response = $response->json();

            // Save to cache
            if ($response['status'] == 'OK') {
                $response = $response['results'];
            } else {
                $response = [];
            }

            cache()->put($cacheKey, $response, now()->addMinutes(60));
        }

        return response()->json([
            'success' => true,
            'data' => $response,
        ]);
    }
}
