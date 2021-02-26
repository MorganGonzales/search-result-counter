<?php

namespace Tests\Unit\Services\SearchEngines;

use App\Services\SearchEngines\GoogleSearchEngine;
use App\Services\SearchEngines\GoogleSearchEngineBuilder;
use App\Services\SearchEngines\SearchEngine;
use Tests\TestCase;

class GoogleSearchEngineBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function it_throws_an_exception_when_apiKey_is_missing()
    {
        $this->expectExceptionMessage(
            'Property `apiKey` is required to create ' . GoogleSearchEngineBuilder::class . ' instance.'
        );

        $builder = new GoogleSearchEngineBuilder();
        $builder->build();
    }

    /**
     * @test
     */
    public function it_throws_an_exception_when_searchEngineId_is_missing()
    {
        $this->expectExceptionMessage(
            'Property `searchEngineId` is required to create ' . GoogleSearchEngineBuilder::class . ' instance.'
        );

        $builder = new GoogleSearchEngineBuilder();
        $builder->setApiKey('sample-api-key')->build();
    }

    /**
     * @test
     */
    public function it_throws_an_exception_when_searchUrl_is_missing()
    {
        $this->expectExceptionMessage(
            'Property `searchUrl` is required to create ' . GoogleSearchEngineBuilder::class . ' instance.'
        );

        $builder = new GoogleSearchEngineBuilder();
        $builder->setApiKey('sample-api-key')->setSearchEngineId('sample-engine-id')->build();
    }

    /**
     * @test
     */
    public function it_creates_a_GoogleSearchEngine_instance()
    {
        $builder = new GoogleSearchEngineBuilder();
        $searchEngine = $builder
            ->setApiKey('sample-api-key')
            ->setSearchEngineId('sample-engine-id')
            ->setSearchUrl('https://www.google.com/')
            ->build();

        $this->assertInstanceOf(GoogleSearchEngine::class, $searchEngine);
    }

    /**
     * @test
     */
    public function it_returns_the_GoogleSearchEngineBuilder_instance_when_setting_the_api_key()
    {
        $builder = new GoogleSearchEngineBuilder();

        $this->assertEquals($builder->setApiKey('sample-api-key'), $builder);
    }

    /**
     * @test
     */
    public function it_returns_the_GoogleSearchEngineBuilder_instance_when_setting_the_search_enging_id()
    {
        $builder = new GoogleSearchEngineBuilder();

        $this->assertEquals($builder->setSearchEngineId('sample-search-engine-id'), $builder);
    }

    /**
     * @test
     */
    public function it_returns_the_GoogleSearchEngineBuilder_instance_when_setting_the_search_url()
    {
        $builder = new GoogleSearchEngineBuilder();

        $this->assertEquals($builder->setSearchUrl('sample-search-url'), $builder);
    }

    /**
     * @test
     */
    public function it_returns_the_GoogleSearchEngineBuilder_instance_when_setting_the_geo_location()
    {
        $builder = new GoogleSearchEngineBuilder();

        $this->assertEquals($builder->setGeolocation('ph'), $builder);
    }
}
