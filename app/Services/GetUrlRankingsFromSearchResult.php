<?php

namespace App\Services;

use App\Factories\SearchEngineBuilderFactory;
use App\Services\SearchEngines\SearchEngine;

class GetUrlRankingsFromSearchResult
{
    private const MAX_RESULT_INDEX = 10;

    private SearchEngine $searchEngine;

    public function __construct()
    {
        $this->searchEngine = self::createSearchEngine();
    }

    // @todo Can be registered in the service provider. Was implemented here for simplicity
    private static function createSearchEngine(): SearchEngine
    {
        $searchEngineBuilder = SearchEngineBuilderFactory::create(env('SEARCH_ENGINE'));

        // @todo Could have used `config` than directly accessing ENV variables here
        return $searchEngineBuilder
            ->setApiKey(env('SEARCH_ENGINE_API_KEY'))
            ->setSearchEngineId(env('SEARCH_ENGINE_ID'))
            ->setSearchUrl(env('SEARCH_ENGINE_URL'))
            ->setGeolocation(env('SEARCH_ENGINE_GEO_LOCATION'))
            ->build();
    }

    public function execute(string $keyword, string $url): array
    {
        $startIndex = 1;
        $apiSearchResults = [];

        while($startIndex <= self::MAX_RESULT_INDEX) {
            $apiSearchResults[] = \json_decode($this->searchEngine->search($keyword, $startIndex));
            $startIndex = \last($apiSearchResults)->queries->nextPage[0]->startIndex ?? self::MAX_RESULT_INDEX + 1;
        }

        return iterator_to_array($this->gatherResultsBasedOnUrlInput(retrieveHostFromUrl($url), $apiSearchResults));
    }

    private function gatherResultsBasedOnUrlInput(string $url, array $searchResults): \Generator
    {
        // @todo Too many indentations - can be improved for readability
        foreach ($searchResults as $searchResult) {
            foreach ($searchResult->items as $index => $item) {
                if (\strpos($item->link, $url) !== false) {
                    yield [
                        'rank' => formatNumberToOrdinal($index + 1),
                        'title' => $item->title,
                        'link' => $item->link,
                        'description' => $item->snippet,
                    ];
                }
            }
        }
    }
}
