<?php

namespace App\Factories;

use App\Services\SearchEngines\SearchEngineBuilder;

class SearchEngineBuilderFactory
{
    public static function create(string $name): SearchEngineBuilder
    {
        $className = 'App\\Services\\SearchEngines\\' . \ucfirst($name) . 'SearchEngineBuilder';

        return new $className;
    }
}
