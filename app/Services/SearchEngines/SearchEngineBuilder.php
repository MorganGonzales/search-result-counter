<?php

namespace App\Services\SearchEngines;

interface SearchEngineBuilder
{
    public function setApiKey(string $apiKey): self;

    public function setSearchEngineId(string $searchEngineId): self;

    public function setSearchUrl(string $url): self;

    public function setGeolocation(string $countryCode): self;

    public function build(): SearchEngine;
}
