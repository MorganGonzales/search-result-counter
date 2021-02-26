<?php

namespace App\Services\SearchEngines;

class GoogleSearchEngineBuilder implements SearchEngineBuilder
{
    private const REQUIRED_PROPERTIES = [
        'apiKey', 'searchEngineId', 'searchUrl'
    ];

    private string $apiKey = '';

    private string $searchEngineId = '';

    private string $searchUrl = '';

    private string $geoLocation = '';

    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    public function setSearchEngineId(string $searchEngineId): self
    {
        $this->searchEngineId = $searchEngineId;

        return $this;
    }

    public function setSearchUrl(string $url): self
    {
        $this->searchUrl = $url;

        return $this;
    }

    public function setGeolocation(string $countryCode): self
    {
        $this->geoLocation = $countryCode;

        return $this;
    }

    public function build(): SearchEngine
    {
        $this->checkIfReadyToBuild();

        $searchEngine = new GoogleSearchEngine($this->apiKey, $this->searchEngineId, $this->searchUrl);
        $searchEngine->setGeoLocation($this->geoLocation);

        return $searchEngine;
    }

    private function checkIfReadyToBuild()
    {
        $className = __CLASS__;

        foreach (self::REQUIRED_PROPERTIES as $property) {
            if (!$this->{$property}) {
                throw new \BadMethodCallException(
                    "Property `{$property}` is required to create {$className} instance."
                );
            }
        }
    }
}
