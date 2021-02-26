<?php

namespace Tests\Unit\Services\SearchEngines;

use App\Services\SearchEngines\GoogleSearchEngine;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GoogleSearchEngineTest extends TestCase
{
    private string $apiKey = 'sample-api-key';

    private string $searchEngineId = 'sample-search-engine-id';

    private string $searchUrl = 'https://customsearch.googleapis.com/customsearch/v1';

    /**
     * @test
     */
    public function it_should_send_a_search_request_without_geo_location()
    {
        Http::fake();

        $params = [
            'key' => $this->apiKey,
            'cx' => $this->searchEngineId,
            'q' => 'Spongebob Squarepants',
            'start' => 25,
        ];

        $searchEngine = new GoogleSearchEngine($this->apiKey, $this->searchEngineId, $this->searchUrl);
        $searchEngine->search('Spongebob Squarepants', 25);

        Http::assertSent(function (Request $request) use ($params) {
            return $request->url() == $this->searchUrl . '?' . \http_build_query($params, '', '&', PHP_QUERY_RFC3986);
        });
    }

    /**
     * @test
     */
    public function it_should_send_a_search_request_with_geo_location()
    {
        Http::fake();

        $params = [
            'key' => $this->apiKey,
            'cx' => $this->searchEngineId,
            'q' => 'Spongebob Squarepants',
            'start' => 25,
            'gl' => 'ph',
        ];

        $searchEngine = new GoogleSearchEngine($this->apiKey, $this->searchEngineId, $this->searchUrl);
        $searchEngine->setGeoLocation('ph');
        $searchEngine->search('Spongebob Squarepants', 25);


        Http::assertSent(function (Request $request) use ($params) {
            return $request->url() == $this->searchUrl . '?' . \http_build_query($params, '', '&', PHP_QUERY_RFC3986);
        });
    }
}
