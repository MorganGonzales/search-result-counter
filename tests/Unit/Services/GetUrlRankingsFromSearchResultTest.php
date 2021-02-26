<?php

namespace Tests\Unit\Services;

use App\Services\GetUrlRankingsFromSearchResult;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GetUrlRankingsFromSearchResultTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_an_array_of_results_that_matches_the_given_url()
    {
        Http::fake([
            '*' => Http::response(self::sampleResponse(), 200)
        ]);
        $expectedResult = [
            [
                'rank' => '1st',
                'title' => 'CreditorWatch: Business Credit Scores and Company Checks',
                'link' => 'https://creditorwatch.com.au/',
                'description' => 'Since we began, CreditorWatch has been helping customers who range...',
            ],
        ];

        $service = new GetUrlRankingsFromSearchResult();
        $result = $service->execute('creditorwatch', 'creditorwatch.com.au');

        Http::assertSentCount(1);

        $this->assertEquals($expectedResult, $result);
    }

    private static function sampleResponse(): string
    {
        return <<<'JSON'
{
  "kind": "customsearch#search",
  "url": {
    "type": "application/json",
    "template": "https://www.googleapis.com/customsearch/v1?q={searchTerms}&num={count?}&start={startIndex?}&lr={language?}&safe={safe?}&cx={cx?}&sort={sort?}&filter={filter?}&gl={gl?}&cr={cr?}&googlehost={googleHost?}&c2coff={disableCnTwTranslation?}&hq={hq?}&hl={hl?}&siteSearch={siteSearch?}&siteSearchFilter={siteSearchFilter?}&exactTerms={exactTerms?}&excludeTerms={excludeTerms?}&linkSite={linkSite?}&orTerms={orTerms?}&relatedSite={relatedSite?}&dateRestrict={dateRestrict?}&lowRange={lowRange?}&highRange={highRange?}&searchType={searchType}&fileType={fileType?}&rights={rights?}&imgSize={imgSize?}&imgType={imgType?}&imgColorType={imgColorType?}&imgDominantColor={imgDominantColor?}&alt=json"
  },
  "queries": {
    "request": [
      {
        "title": "Google Custom Search - creditorwatch",
        "totalResults": "342000",
        "searchTerms": "creditorwatch",
        "count": 10,
        "startIndex": 1,
        "inputEncoding": "utf8",
        "outputEncoding": "utf8",
        "safe": "off",
        "cx": "ed96d8942bd13ee82",
        "gl": "au"
      }
    ],
    "nextPage": [
      {
        "title": "Google Custom Search - creditorwatch",
        "totalResults": "342000",
        "searchTerms": "creditorwatch",
        "count": 10,
        "startIndex": 11,
        "inputEncoding": "utf8",
        "outputEncoding": "utf8",
        "safe": "off",
        "cx": "ed96d8942bd13ee82",
        "gl": "au"
      }
    ]
  },
  "context": {
    "title": "Morgy Search"
  },
  "searchInformation": {
    "searchTime": 0.509397,
    "formattedSearchTime": "0.51",
    "totalResults": "342000",
    "formattedTotalResults": "342,000"
  },
  "items": [
    {
      "kind": "customsearch#result",
      "title": "CreditorWatch: Business Credit Scores and Company Checks",
      "htmlTitle": "\u003cb\u003eCreditorWatch\u003c/b\u003e: Business Credit Scores and Company Checks",
      "link": "https://creditorwatch.com.au/",
      "displayLink": "creditorwatch.com.au",
      "snippet": "Since we began, CreditorWatch has been helping customers who range...",
      "htmlSnippet": "Since we began, \u003cb\u003eCreditorWatch\u003c/b\u003e has been helping customers who range from \u003cbr\u003e\nsole traders through to ASX-listed companies, to better understand who their&nbsp;...",
      "cacheId": "oTM0STBzeooJ",
      "formattedUrl": "https://creditorwatch.com.au/",
      "htmlFormattedUrl": "https://\u003cb\u003ecreditorwatch\u003c/b\u003e.com.au/",
      "pagemap": {
        "cse_thumbnail": [
          {
            "src": "https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQ8Lzs1g0csvxR7POaKA19pVWem7B5SsrHyjsak2m6eIGWjHPvBV4cuNLM",
            "width": "232",
            "height": "114"
          }
        ],
        "metatags": [
          {
            "application-name": "CreditorWatch",
            "msapplication-tilecolor": "#00687a",
            "og:image": "https://creditorwatch.com.au/wp-content/themes/creditorwatch/img/asset-customer-logo-toll@2x.png",
            "msapplication-square70x70logo": "https://creditorwatch.com.au/wp-content/themes/creditorwatch/img/tiny.png",
            "og:type": "website",
            "twitter:card": "summary_large_image",
            "og:site_name": "CreditorWatch",
            "og:title": "Business Credit Scores and Company Checks | CreditorWatch",
            "msapplication-wide310x150logo": "https://creditorwatch.com.au/wp-content/themes/creditorwatch/img/wide.png",
            "bingbot": "index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1",
            "msapplication-square150x150logo": "https://creditorwatch.com.au/wp-content/themes/creditorwatch/img/square.png",
            "ahrefs-site-verification": "4c99038a46588746e86ae54bee0f72eb5368968caaa2189a4f47c267cae0f850",
            "article:modified_time": "2020-09-17T05:41:10+00:00",
            "viewport": "width=device-width, initial-scale=1",
            "msapplication-square310x310logo": "https://creditorwatch.com.au/wp-content/themes/creditorwatch/img/large.png",
            "og:locale": "en_US",
            "og:url": "https://creditorwatch.com.au/"
          }
        ],
        "cse_image": [
          {
            "src": "https://creditorwatch.com.au/wp-content/themes/creditorwatch/img/asset-customer-logo-toll@2x.png"
          }
        ]
      }
    }
  ]
}
JSON;
    }
}
