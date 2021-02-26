<?php

namespace App\Services;

use App\Factories\SearchEngineBuilderFactory;
use App\Services\SearchEngines\SearchEngine;

class GetUrlRankingsFromSearchResult
{
    private const MAX_RESULT_INDEX = 10;

    private static function createSearchEngine(): SearchEngine
    {
        $searchEngineBuilder = SearchEngineBuilderFactory::create(env('SEARCH_ENGINE'));

        return $searchEngineBuilder
            ->setApiKey(env('SEARCH_ENGINE_API_KEY'))
            ->setSearchEngineId(env('SEARCH_ENGINE_ID'))
            ->setSearchUrl(env('SEARCH_ENGINE_URL'))
            ->build();
    }

    private static function formatNumberToOrdinal(int $number): string
    {
        $ends = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];

        return ((($number % 100) >= 11) && (($number % 100) <= 13))
            ? $number . 'th'
            : $number . $ends[$number % 10];
    }

    public function execute(string $keyword, string $url): array
    {
        $startIndex = 1;
        $searchEngine = self::createSearchEngine();
        $searchResults = [];

        while($startIndex <= self::MAX_RESULT_INDEX) {
            $searchResults[] = \json_decode($searchEngine->search($keyword, $startIndex));
            $startIndex = \last($searchResults)->queries->nextPage[0]->startIndex ?? self::MAX_RESULT_INDEX + 1;
        }

        return iterator_to_array($this->gatherResultsBasedOnUrlInput($url, $searchResults));
    }

    private function gatherResultsBasedOnUrlInput(string $url, array $searchResults): \Generator
    {
        foreach ($searchResults as $searchResult) {
            foreach ($searchResult->items as $index => $item) {
                if (\strpos($item->link, $url)) {
                    yield [
                        'rank' => self::formatNumberToOrdinal($index + 1),
                        'title' => $item->title,
                        'link' => $item->link,
                        'description' => $item->snippet,
                    ];
                }
            }
        }
    }
}
