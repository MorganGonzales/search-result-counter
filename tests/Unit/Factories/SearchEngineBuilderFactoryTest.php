<?php

namespace Tests\Unit\Factories;

use App\Factories\SearchEngineBuilderFactory;
use App\Services\SearchEngines\SearchEngineBuilder;
use Tests\TestCase;

class SearchEngineBuilderFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_the_concrete_search_engine_builder_class()
    {
        $builder = SearchEngineBuilderFactory::create('Google');

        $this->assertInstanceOf(SearchEngineBuilder::class, $builder);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_when_search_engine_class_is_unknown()
    {
        $this->expectException(\Error::class);

        SearchEngineBuilderFactory::create('Unknown');
    }
}
