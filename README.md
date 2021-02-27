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


## Design Patterns Used

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

In this scenario, I didn't create a specific director class, but simply included it as part of the `GetUrlRankingsFromSearchResult` service class. 
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



