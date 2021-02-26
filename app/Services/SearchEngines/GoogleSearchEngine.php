<?php

namespace App\Services\SearchEngines;

use Illuminate\Support\Facades\Http;

class GoogleSearchEngine implements SearchEngine
{
    private string $apiKey;

    private string $searchEngineId;

    private string $searchUrl;

    private string $geoLocation = '';

    public function __construct(string $apiKey, string $searchEngineId, string $searchUrl)
    {
        $this->apiKey = $apiKey;
        $this->searchEngineId = $searchEngineId;
        $this->searchUrl = $searchUrl;
    }

    public function setGeoLocation(string $countryCode)
    {
        $this->geoLocation = $countryCode;
    }

    public function search(string $keyword, int $startIndex = 1): string
    {
        $response = Http::get($this->searchUrl, \array_filter([
            'key' => $this->apiKey,
            'cx' => $this->searchEngineId,
            'q' => $keyword,
            'start' => $startIndex,
            'gl' => $this->geoLocation,
        ]));

        return $response->body();
    }
}
