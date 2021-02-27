# Search Result Ranking

A micro web-application that allows users to parse Google Search Results (or any search engines) and list all results where the link contains the given URL.
> **Note:** This application was created using [Laravel 8 Framework](https://laravel.com/docs/8.x) and utilizes [Google's Custom Search JSON API](https://developers.google.com/custom-search/v1/introduction) which only has a limit of 100 (search) requests per day.

## Installation
To install, you simply clone this repository:

```shell
$ git clone https://github.com/MorganGonzales/search-result-ranking.git
```

Then install its dependencies using [Composer](https://getcomposer.org/).

```shell
$ composer install
```

Copy the .env.example file and rename it to **.env**. 

These variables are application specific hence needs to be specified.

```
APP_NAME='Search Result Ranking'
APP_ENV=local
APP_DEBUG=true
APP_URL=http://search-result-ranking.herokuapp.com/
```

>>**Note:** Set APP_ENV=production when deploying in production

You need to specify these fields in your **.env** to integrate this application with Google Custom Search API.

```
SEARCH_ENGINE_API_KEY=
SEARCH_ENGINE_ID=
```

For more information on how to setup Google Custom Search API, you may refer to this [documentation](https://developers.google.com/custom-search/v1/introduction)


## Design Patterns Applied

### [Factory Method](https://refactoring.guru/design-patterns/factory-method)

This is the concrete creator class that creates a SearchEngineBuilder instance based on the $name provided.

```php
class SearchEngineBuilderFactory
{
    public static function create(string $name): SearchEngineBuilder
    {
        $className = 'App\\Services\\SearchEngines\\' . \ucfirst($name) . 'SearchEngineBuilder';

        return new $className;
    }
}
```

Usage (somewhere in GetUrlRankingsFromSearchResult.php)

```php
$searchEngineBuilder = SearchEngineBuilderFactory::create(env('SEARCH_ENGINE'));  
  
return $searchEngineBuilder  
    ->setApiKey(env('SEARCH_ENGINE_API_KEY'))  
    ->setSearchEngineId(env('SEARCH_ENGINE_ID'))  
    ->setSearchUrl(env('SEARCH_ENGINE_URL'))  
    ->build();
````

### [Builder Pattern](https://refactoring.guru/design-patterns/builder)

This is the builder interface which specifies the methods for creating the necessary parameters for the SearchEngine object

```php
/**
 * SearchEngineBuilder.php 
 */
interface SearchEngineBuilder
{
    public function setApiKey(string $apiKey): self;

    public function setSearchEngineId(string $searchEngineId): self;

    public function setSearchUrl(string $url): self;

    public function setGeolocation(string $countryCode): self;

    public function build(): SearchEngine;
}
```

The concrete builder class that follows the builder interface (above) and provide specific implementations of the builder steps. Mutator methods are intentionally defined to be fluent to allow chaining.

```php
/**
 * GoogleSearchEngineBuilder.php
 */
class GoogleSearchEngineBuilder implements SearchEngineBuilder
{
    // Some codes here...

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

    // Some other codes here ...
}
```

In this scenario, a specific director class was not created for simplicity. Instead, it was included as part of the `GetUrlRankingsFromSearchResult` service class. 
This code snippet (which can be in a separate director class) is responsible for executing the building steps in a particular sequence (sequence does not matter much in this case) 

```php
// GetUrlRankingsFromSearchResult.php
private static function createSearchEngine(): SearchEngine
{
    $searchEngineBuilder = SearchEngineBuilderFactory::create(env('SEARCH_ENGINE'));

    return $searchEngineBuilder
        ->setApiKey(env('SEARCH_ENGINE_API_KEY'))
        ->setSearchEngineId(env('SEARCH_ENGINE_ID'))
        ->setSearchUrl(env('SEARCH_ENGINE_URL'))
        ->build();
}
```

## Running Test

To execute both unit and feature test, you may enter this command (on your local)

```shell
$ php artisan test
```

Alternatively, you can simply just run PHPUnit

```shell
$ vendor/bin/phpunit
```

## Developer Notes

- The current search result is simply being flashed to the session variable for simplicity. If persistence of historical results will be needed, a database storage will be required.
- If we want to support various search engines (other than Google), it would require to set a configuration file for each type as configuration options may vary.
