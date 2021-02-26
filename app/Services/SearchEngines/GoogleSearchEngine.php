<?php

namespace App\Services\SearchEngines;

use Illuminate\Support\Facades\Http;

class GoogleSearchEngine implements SearchEngine
{
    private string $apiKey;

    private string $searchEngineId;

    private string $searchUrl;

    private string $geoLocation = '';

    public function __construct(string $apiKey, string $searchEngineId, string $searchUrl)
    {
        $this->apiKey = $apiKey;
        $this->searchEngineId = $searchEngineId;
        $this->searchUrl = $searchUrl;
    }

    public function setGeoLocation(string $countryCode)
    {
        $this->geoLocation = $countryCode;
    }

    public function search(string $keyword, int $startIndex = 1): string
    {
//        return self::data();

        $response = Http::get($this->searchUrl, \array_filter([
            'key' => $this->apiKey,
            'cx' => $this->searchEngineId,
            'q' => $keyword,
            'start' => $startIndex,
            'gl' => $this->geoLocation,
        ]));

        return $response->body();
    }

    private static function data(): string
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
      "snippet": "Since we began, CreditorWatch has been helping customers who range from \nsole traders through to ASX-listed companies, to better understand who their ...",
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
    },
    {
      "kind": "customsearch#result",
      "title": "Patrick Coghlan - Chief Executive Officer - CreditorWatch | LinkedIn",
      "htmlTitle": "Patrick Coghlan - Chief Executive Officer - \u003cb\u003eCreditorWatch\u003c/b\u003e | LinkedIn",
      "link": "https://au.linkedin.com/in/patrick-coghlan-sydney",
      "displayLink": "au.linkedin.com",
      "snippet": "CreditorWatch is a commercial credit reporting bureau with over 50,000 \ncustomers, from sole traders through to ASX listed public companies. \nCreditorWatch ...",
      "htmlSnippet": "\u003cb\u003eCreditorWatch\u003c/b\u003e is a commercial credit reporting bureau with over 50,000 \u003cbr\u003e\ncustomers, from sole traders through to ASX listed public companies. \u003cbr\u003e\n\u003cb\u003eCreditorWatch\u003c/b\u003e&nbsp;...",
      "formattedUrl": "https://au.linkedin.com/in/patrick-coghlan-sydney",
      "htmlFormattedUrl": "https://au.linkedin.com/in/patrick-coghlan-sydney",
      "pagemap": {
        "cse_thumbnail": [
          {
            "src": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRL9aCdWrKt08geFSyF1iRFRWIBczbRl8Gy44PWrO9ii4JqTzAad3ZL-A",
            "width": "100",
            "height": "100"
          }
        ],
        "metatags": [
          {
            "og:image": "https://media-exp1.licdn.com/dms/image/C4E03AQHypuaiUZNe9Q/profile-displayphoto-shrink_200_200/0/1516336233719?e=1619654400&v=beta&t=fi9A3R3m4Tt1HT6CND3y2hpuJW4kIxbvj1Q7sEVe2uE",
            "og:type": "profile",
            "twitter:card": "summary",
            "twitter:title": "Patrick Coghlan - Chief Executive Officer - CreditorWatch | LinkedIn",
            "al:ios:app_name": "LinkedIn",
            "platform-worker": "https://static-exp1.licdn.com/sc/h/f1rrg2iyfxtin8sa39nl5yphl",
            "og:title": "Patrick Coghlan - Chief Executive Officer - CreditorWatch | LinkedIn",
            "al:android:package": "com.linkedin.android",
            "pagekey": "public_profile_v3_mobile",
            "locale": "en_US",
            "al:ios:url": "https://au.linkedin.com/in/patrick-coghlan-sydney",
            "og:description": "View Patrick Coghlan’s profile on LinkedIn, the world’s largest professional community. Patrick has 5 jobs listed on their profile. See the complete profile on LinkedIn and discover Patrick’s connections and jobs at similar companies.",
            "al:ios:app_store_id": "288429040",
            "platform": "https://static-exp1.licdn.com/sc/h/9jz7j4nt804mq3yk6akvsioxt,g6r34w5fcy8cris98mp023g",
            "twitter:image": "https://media-exp1.licdn.com/dms/image/C4E03AQHypuaiUZNe9Q/profile-displayphoto-shrink_200_200/0/1516336233719?e=1619654400&v=beta&t=fi9A3R3m4Tt1HT6CND3y2hpuJW4kIxbvj1Q7sEVe2uE",
            "al:android:url": "https://au.linkedin.com/in/patrick-coghlan-sydney",
            "profile:last_name": "Coghlan",
            "twitter:site": "@Linkedin",
            "viewport": "width=device-width, initial-scale=1.0",
            "litmsprofilename": "public-profile-frontend",
            "twitter:description": "View Patrick Coghlan’s profile on LinkedIn, the world’s largest professional community. Patrick has 5 jobs listed on their profile. See the complete profile on LinkedIn and discover Patrick’s connections and jobs at similar companies.",
            "profile:first_name": "Patrick",
            "og:url": "https://au.linkedin.com/in/patrick-coghlan-sydney",
            "al:android:app_name": "LinkedIn"
          }
        ],
        "cse_image": [
          {
            "src": "https://media-exp1.licdn.com/dms/image/C4E0BAQE-tAWQ8op-hg/company-logo_100_100/0/1603850272181?e=1622073600&v=beta&t=kmD2hnIbjN4hwjisZVlB3XTAcCpL388-wo6Oc28M0Mc"
          }
        ]
      }
    },
    {
      "kind": "customsearch#result",
      "title": "Login - Company Credit Check Services - CreditorWatch",
      "htmlTitle": "Login - Company Credit Check Services - \u003cb\u003eCreditorWatch\u003c/b\u003e",
      "link": "https://creditorwatch.com.au/login",
      "displayLink": "creditorwatch.com.au",
      "snippet": "Click here to login into CreditorWatch and access our credit reporting, business \nmonitoring and debt collection tools.",
      "htmlSnippet": "Click here to login into \u003cb\u003eCreditorWatch\u003c/b\u003e and access our credit reporting, business \u003cbr\u003e\nmonitoring and debt collection tools.",
      "cacheId": "dEhkNULMc_UJ",
      "formattedUrl": "https://creditorwatch.com.au/login",
      "htmlFormattedUrl": "https://\u003cb\u003ecreditorwatch\u003c/b\u003e.com.au/login",
      "pagemap": {
        "metatags": [
          {
            "application-name": "CreditorWatch",
            "msapplication-tilecolor": "#00687a",
            "msapplication-square70x70logo": "/tiny.png",
            "viewport": "width=device-width, initial-scale=1.0",
            "msapplication-square310x310logo": "/large.png",
            "msapplication-wide310x150logo": "/wide.png",
            "msapplication-square150x150logo": "/square.png"
          }
        ]
      }
    },
    {
      "kind": "customsearch#result",
      "title": "CreditorWatch | LinkedIn",
      "htmlTitle": "\u003cb\u003eCreditorWatch\u003c/b\u003e | LinkedIn",
      "link": "https://au.linkedin.com/company/creditor-watch",
      "displayLink": "au.linkedin.com",
      "snippet": "CreditorWatch is a commercial credit reporting bureau with over 50,000 \ncustomers across Australia, from sole traders through to ASX listed public \ncompanies.",
      "htmlSnippet": "\u003cb\u003eCreditorWatch\u003c/b\u003e is a commercial credit reporting bureau with over 50,000 \u003cbr\u003e\ncustomers across Australia, from sole traders through to ASX listed public \u003cbr\u003e\ncompanies.",
      "formattedUrl": "https://au.linkedin.com/company/creditor-watch",
      "htmlFormattedUrl": "https://au.linkedin.com/company/\u003cb\u003ecreditor-watch\u003c/b\u003e",
      "pagemap": {
        "cse_thumbnail": [
          {
            "src": "https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRoXL85vLOskn2qvobu5wrkIiHdSBS8fwSltpMVZIRfnn26E7O6Mcf_lfE",
            "width": "200",
            "height": "200"
          }
        ],
        "metatags": [
          {
            "og:image": "https://media-exp1.licdn.com/dms/image/C560BAQGL4113H8tt9w/company-logo_200_200/0/1594955481354?e=2159024400&v=beta&t=y_j-0U17I8wiVQG1_29NIOeCtcohtQKzqH6A9SD-gcw",
            "og:type": "article",
            "twitter:card": "summary",
            "twitter:title": "CreditorWatch | LinkedIn",
            "al:ios:app_name": "LinkedIn",
            "og:title": "CreditorWatch | LinkedIn",
            "al:android:package": "com.linkedin.android",
            "pagekey": "p_org_guest_company_overview",
            "locale": "en_US",
            "al:ios:url": "https://au.linkedin.com/company/creditor-watch",
            "og:description": "CreditorWatch | 3,188 followers on LinkedIn. Commercial credit reporting bureau with over 50,000 customers. Get access to unique credit risk insights and features. | CreditorWatch is a commercial credit reporting bureau with over 50,000 customers across Australia, from sole traders through to ASX listed public companies. \n\nCreditorWatch holds the credit file of every entity in Australia and enables businesses of all sizes to access credit risk information on any entity in Australia (including sole traders, trusts and partnerships) to determine what sort of risk they represent to their business.\n\nCreditorWatch services and products:\n✓ Credit reports and credit scores\n✓ Company monitoring and alerts\n✓ Debt collection tools\n✓ Datawashing\n✓ ApplyEasy - Online credit applications\n✓ Automated decisioning\n✓ Trade Program\n\nFor more information please visit www.creditorwatch.com.au or contact us on 1300 50 13 12.",
            "al:ios:app_store_id": "288429040",
            "twitter:image": "https://media-exp1.licdn.com/dms/image/C560BAQGL4113H8tt9w/company-logo_200_200/0/1594955481354?e=2159024400&v=beta&t=y_j-0U17I8wiVQG1_29NIOeCtcohtQKzqH6A9SD-gcw",
            "al:android:url": "https://au.linkedin.com/company/creditor-watch",
            "twitter:site": "@linkedin",
            "viewport": "width=device-width, initial-scale=1.0",
            "twitter:description": "CreditorWatch | 3,188 followers on LinkedIn. Commercial credit reporting bureau with over 50,000 customers. Get access to unique credit risk insights and features. | CreditorWatch is a commercial credit reporting bureau with over 50,000 customers across Australia, from sole traders through to ASX listed public companies. \n\nCreditorWatch holds the credit file of every entity in Australia and enables businesses of all sizes to access credit risk information on any entity in Australia (including sole traders, trusts and partnerships) to determine what sort of risk they represent to their business.\n\nCreditorWatch services and products:\n✓ Credit reports and credit scores\n✓ Company monitoring and alerts\n✓ Debt collection tools\n✓ Datawashing\n✓ ApplyEasy - Online credit applications\n✓ Automated decisioning\n✓ Trade Program\n\nFor more information please visit www.creditorwatch.com.au or contact us on 1300 50 13 12.",
            "og:url": "https://au.linkedin.com/company/creditor-watch",
            "al:android:app_name": "LinkedIn"
          }
        ],
        "cse_image": [
          {
            "src": "https://media-exp1.licdn.com/dms/image/C560BAQGL4113H8tt9w/company-logo_200_200/0/1594955481354?e=2159024400&v=beta&t=y_j-0U17I8wiVQG1_29NIOeCtcohtQKzqH6A9SD-gcw"
          }
        ]
      }
    },
    {
      "kind": "customsearch#result",
      "title": "Start Your Free Trial - CreditorWatch",
      "htmlTitle": "Start Your Free Trial - \u003cb\u003eCreditorWatch\u003c/b\u003e",
      "link": "https://creditorwatch.com.au/pricing",
      "displayLink": "creditorwatch.com.au",
      "snippet": "All Plans Include: Credit Management Tools; Debt Collection Tools. Register \nPayment Defaults; Accounting Integration. Monitoring & Alerts; CreditorWatch \nLogo ...",
      "htmlSnippet": "All Plans Include: Credit Management Tools; Debt Collection Tools. Register \u003cbr\u003e\nPayment Defaults; Accounting Integration. Monitoring &amp; Alerts; \u003cb\u003eCreditorWatch\u003c/b\u003e \u003cbr\u003e\nLogo&nbsp;...",
      "cacheId": "CDY2y1J0n1QJ",
      "formattedUrl": "https://creditorwatch.com.au/pricing",
      "htmlFormattedUrl": "https://\u003cb\u003ecreditorwatch\u003c/b\u003e.com.au/pricing",
      "pagemap": {
        "cse_thumbnail": [
          {
            "src": "https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRlCvMJrbbSMc-GFoCG54Bn3mMXYcA36LCtHRRJKHCq2HKO15ajQ-IJA1c",
            "width": "298",
            "height": "169"
          }
        ],
        "metatags": [
          {
            "application-name": "CreditorWatch",
            "msapplication-tilecolor": "#00687a",
            "ahrefs-site-verification": "4c99038a46588746e86ae54bee0f72eb5368968caaa2189a4f47c267cae0f850",
            "msapplication-square70x70logo": "/tiny.png",
            "viewport": "width=device-width, initial-scale=1",
            "msapplication-square310x310logo": "/large.png",
            "msapplication-wide310x150logo": "/wide.png",
            "msapplication-square150x150logo": "/square.png"
          }
        ],
        "cse_image": [
          {
            "src": "https://creditorwatch.com.au/video_2014.jpg"
          }
        ]
      }
    },
    {
      "kind": "customsearch#result",
      "title": "CreditorWatch - Wikipedia",
      "htmlTitle": "\u003cb\u003eCreditorWatch\u003c/b\u003e - Wikipedia",
      "link": "https://en.wikipedia.org/wiki/CreditorWatch",
      "displayLink": "en.wikipedia.org",
      "snippet": "CreditorWatch is an Australian credit reporting agency that manages the credit \nfiles of all commercial businesses in Australia. It is a subscription based ...",
      "htmlSnippet": "\u003cb\u003eCreditorWatch\u003c/b\u003e is an Australian credit reporting agency that manages the credit \u003cbr\u003e\nfiles of all commercial businesses in Australia. It is a subscription based&nbsp;...",
      "cacheId": "nfikQGirvC4J",
      "formattedUrl": "https://en.wikipedia.org/wiki/CreditorWatch",
      "htmlFormattedUrl": "https://en.wikipedia.org/wiki/\u003cb\u003eCreditorWatch\u003c/b\u003e",
      "pagemap": {
        "hcard": [
          {
            "url_text": "creditorwatch.com.au",
            "fn": "CreditorWatch",
            "category": "Private company",
            "url": "creditorwatch.com.au"
          }
        ],
        "metatags": [
          {
            "referrer": "origin"
          }
        ]
      }
    },
    {
      "kind": "customsearch#result",
      "title": "CreditorWatch - Home | Facebook",
      "htmlTitle": "\u003cb\u003eCreditorWatch\u003c/b\u003e - Home | Facebook",
      "link": "https://www.facebook.com/CreditorWatchAU/",
      "displayLink": "www.facebook.com",
      "snippet": "CreditorWatch is an innovative and customer-centric commercial credit reporting \nbureau, empowering u... See More. CommunitySee All.",
      "htmlSnippet": "\u003cb\u003eCreditorWatch\u003c/b\u003e is an innovative and customer-centric commercial credit reporting \u003cbr\u003e\nbureau, empowering u... See More. CommunitySee All.",
      "cacheId": "F5BLhUV8PR0J",
      "formattedUrl": "https://www.facebook.com/CreditorWatchAU/",
      "htmlFormattedUrl": "https://www.facebook.com/\u003cb\u003eCreditorWatch\u003c/b\u003eAU/",
      "pagemap": {
        "cse_thumbnail": [
          {
            "src": "https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSbYPdQvVoi_nBpxnkuJl_Z0F8pr8toFTr0fhmOBwAnNntqW-eoWV8cxF8",
            "width": "364",
            "height": "138"
          }
        ],
        "organization": [
          {
            "image": "https://lookaside.fbsbx.com/lookaside/crawler/media/?media_id=158362990867063"
          }
        ],
        "metatags": [
          {
            "al:android:url": "fb://page/158362990867063?referrer=app_link",
            "referrer": "default",
            "og:image": "https://lookaside.fbsbx.com/lookaside/crawler/media/?media_id=158362990867063",
            "al:ios:app_name": "Facebook",
            "og:title": "CreditorWatch",
            "al:android:package": "com.facebook.katana",
            "al:ios:url": "fb://page/?id=158362990867063",
            "og:url": "https://www.facebook.com/CreditorWatchAU/",
            "og:description": "CreditorWatch, Sydney, Australia. 2,062 likes. Providing affordable credit reporting and debt collection services for all businesses. Get paid faster and reduce bad debt. Trial us for free today.",
            "al:android:app_name": "Facebook",
            "al:ios:app_store_id": "284882215"
          }
        ],
        "cse_image": [
          {
            "src": "https://lookaside.fbsbx.com/lookaside/crawler/media/?media_id=2875326672504001"
          }
        ],
        "listitem": [
          {
            "item": "Places",
            "name": "Places",
            "position": "1"
          },
          {
            "item": "Sydney, Australia",
            "name": "Sydney, Australia",
            "position": "2"
          }
        ]
      }
    },
    {
      "kind": "customsearch#result",
      "title": "Search provider InfoTrack buys CreditorWatch",
      "htmlTitle": "Search provider InfoTrack buys \u003cb\u003eCreditorWatch\u003c/b\u003e",
      "link": "https://www.afr.com/technology/search-provider-infotrack-buys-creditorwatch-20171005-gyuod8",
      "displayLink": "www.afr.com",
      "snippet": "10 Oct 2017 ... Its data is allowing CreditorWatch to build models for predicting small business \ncredit risk. Deal: Stephen Wood, executive chair of InfoTrack, ...",
      "htmlSnippet": "10 Oct 2017 \u003cb\u003e...\u003c/b\u003e Its data is allowing \u003cb\u003eCreditorWatch\u003c/b\u003e to build models for predicting small business \u003cbr\u003e\ncredit risk. Deal: Stephen Wood, executive chair of InfoTrack,&nbsp;...",
      "formattedUrl": "https://www.afr.com/.../search-provider-infotrack-buys-creditorwatch- 20171005-gyuod8",
      "htmlFormattedUrl": "https://www.afr.com/.../search-provider-infotrack-buys-\u003cb\u003ecreditorwatch\u003c/b\u003e- 20171005-gyuod8",
      "pagemap": {
        "cse_thumbnail": [
          {
            "src": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-GRJUDH7B9s8oQMGVn4K-a8O81bfsLuwlTMWh8W3VK4vLDBzVN15G-hs",
            "width": "311",
            "height": "162"
          }
        ],
        "metatags": [
          {
            "apple-itunes-app": "524599864",
            "og:image": "https://static.ffx.io/images/$zoom_1%2C$multiply_0.692%2C$ratio_1.5%2C$width_896%2C$x_576%2C$y_0/t_crop_custom/e_sharpen:25%2Cq_85%2Cf_jpg/t_afr_no_label_social_wm/l_text:SuecaNano-Semibold.ttf_28:%20FROM%20%2Cg_south_west%2Cy_84%2Cx_355%2Cco_rgb:111111//l_text:SuecaNano-Semibold.ttf_56:%202017%20%2Cg_south_west%2Cy_25%2Cx_330%2Cco_rgb:111111/4d95964eb777b96b7dabc06fbcf9136d2f1a0e26",
            "article:published_time": "2017-10-09T13:00:00Z",
            "og:image:width": "1200",
            "twitter:card": "summary_large_image",
            "og:site_name": "Australian Financial Review",
            "parsely-author": "James Eyers",
            "og:description": "Valued at more than $1 billion, InfoTrack has put its head above the parapet with a strategic acquisition.",
            "parsely-metadata": "{\"id\":\"gyuod8\",\"type\":\"article\"}",
            "article:publisher": "https://www.facebook.com/financialreview",
            "og:image:secure_url": "https://static.ffx.io/images/$zoom_1%2C$multiply_0.692%2C$ratio_1.5%2C$width_896%2C$x_576%2C$y_0/t_crop_custom/e_sharpen:25%2Cq_85%2Cf_jpg/t_afr_no_label_social_wm/l_text:SuecaNano-Semibold.ttf_28:%20FROM%20%2Cg_south_west%2Cy_84%2Cx_355%2Cco_rgb:111111//l_text:SuecaNano-Semibold.ttf_56:%202017%20%2Cg_south_west%2Cy_25%2Cx_330%2Cco_rgb:111111/4d95964eb777b96b7dabc06fbcf9136d2f1a0e26",
            "parsely-network-canonical": "https://www.afr.com/technology/search-provider-infotrack-buys-creditorwatch-20171005-gyuod8",
            "parsely-type": "NewsArticle",
            "twitter:site": "@FinancialReview",
            "article:modified_time": "2017-10-09T13:00:00Z",
            "news_keywords": "Infotrack, Creditorwatch",
            "parsely-link": "https://www.afr.com/technology/search-provider-infotrack-buys-creditorwatch-20171005-gyuod8",
            "parsely-image-url": "https://static.ffx.io/images/$zoom_1%2C$multiply_0.692%2C$ratio_1.5%2C$width_896%2C$x_576%2C$y_0/t_crop_custom/e_sharpen:25%2Cq_85%2Cf_jpg/t_afr_no_label_social_wm/l_text:SuecaNano-Semibold.ttf_28:%20FROM%20%2Cg_south_west%2Cy_84%2Cx_355%2Cco_rgb:111111//l_text:SuecaNano-Semibold.ttf_56:%202017%20%2Cg_south_west%2Cy_25%2Cx_330%2Cco_rgb:111111/4d95964eb777b96b7dabc06fbcf9136d2f1a0e26",
            "parsely-section": "technology",
            "og:type": "article",
            "article:section": "technology",
            "twitter:title": "Search provider InfoTrack buys CreditorWatch",
            "og:title": "Search provider InfoTrack buys CreditorWatch",
            "og:image:height": "628",
            "fb:pages": "150910108292573",
            "parsely-title": "Search provider InfoTrack buys CreditorWatch",
            "parsely-pub-date": "2017-10-09T13:00:00Z",
            "twitter:image:src": "https://static.ffx.io/images/$zoom_1%2C$multiply_0.692%2C$ratio_1.5%2C$width_896%2C$x_576%2C$y_0/t_crop_custom/e_sharpen:25%2Cq_85%2Cf_jpg/t_afr_no_label_social_wm/l_text:SuecaNano-Semibold.ttf_28:%20FROM%20%2Cg_south_west%2Cy_84%2Cx_355%2Cco_rgb:111111//l_text:SuecaNano-Semibold.ttf_56:%202017%20%2Cg_south_west%2Cy_25%2Cx_330%2Cco_rgb:111111/4d95964eb777b96b7dabc06fbcf9136d2f1a0e26",
            "fb:app_id": "112905165500100",
            "viewport": "width=device-width, initial-scale=1.0",
            "twitter:description": "Valued at more than $1 billion, InfoTrack has put its head above the parapet with a strategic acquisition.",
            "og:url": "https://www.afr.com/technology/search-provider-infotrack-buys-creditorwatch-20171005-gyuod8"
          }
        ],
        "cse_image": [
          {
            "src": "https://static.ffx.io/images/$zoom_1%2C$multiply_0.692%2C$ratio_1.5%2C$width_896%2C$x_576%2C$y_0/t_crop_custom/e_sharpen:25%2Cq_85%2Cf_jpg/t_afr_no_label_social_wm/l_text:SuecaNano-Semibold.ttf_28:%20FROM%20%2Cg_south_west%2Cy_84%2Cx_355%2Cco_rgb:111111//l_text:SuecaNano-Semibold.ttf_56:%202017%20%2Cg_south_west%2Cy_25%2Cx_330%2Cco_rgb:111111/4d95964eb777b96b7dabc06fbcf9136d2f1a0e26"
          }
        ]
      }
    },
    {
      "kind": "customsearch#result",
      "title": "CreditorWatch (@creditorwatch) | Twitter",
      "htmlTitle": "\u003cb\u003eCreditorWatch\u003c/b\u003e (@\u003cb\u003ecreditorwatch\u003c/b\u003e) | Twitter",
      "link": "https://twitter.com/creditorwatch?lang=en",
      "displayLink": "twitter.com",
      "snippet": "The latest Tweets from CreditorWatch (@creditorwatch). Affordable credit \nreporting and debtor monitoring solution for all businesses. Get paid faster and \nreduce ...",
      "htmlSnippet": "The latest Tweets from \u003cb\u003eCreditorWatch\u003c/b\u003e (@\u003cb\u003ecreditorwatch\u003c/b\u003e). Affordable credit \u003cbr\u003e\nreporting and debtor monitoring solution for all businesses. Get paid faster and \u003cbr\u003e\nreduce&nbsp;...",
      "cacheId": "jr2UBRHw-ykJ",
      "formattedUrl": "https://twitter.com/creditorwatch?lang=en",
      "htmlFormattedUrl": "https://twitter.com/\u003cb\u003ecreditorwatch\u003c/b\u003e?lang=en",
      "pagemap": {
        "cse_thumbnail": [
          {
            "src": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTNSk0PLcogC2h8G3U5e5Uy8Swdcmnmsf3OU6L4IU_B_e7IgDFNwveeQ7lj",
            "width": "225",
            "height": "225"
          }
        ],
        "xfn": [
          {}
        ],
        "metatags": [
          {
            "msapplication-tilecolor": "#00aced",
            "al:android:url": "twitter://user?screen_name=creditorwatch",
            "al:ios:app_name": "Twitter",
            "swift-page-section": "profile",
            "al:android:package": "com.twitter.android",
            "swift-page-name": "profile",
            "msapplication-tileimage": "//abs.twimg.com/favicons/win8-tile-144.png",
            "al:ios:url": "twitter://user?screen_name=creditorwatch",
            "al:ios:app_store_id": "333903271",
            "al:android:app_name": "Twitter"
          }
        ],
        "cse_image": [
          {
            "src": "https://pbs.twimg.com/profile_images/555601938318757888/2HsgMnAO_400x400.jpeg"
          }
        ]
      }
    },
    {
      "kind": "customsearch#result",
      "title": "CreditorWatch Credit Report | InfoTrack",
      "htmlTitle": "\u003cb\u003eCreditorWatch\u003c/b\u003e Credit Report | InfoTrack",
      "link": "https://www.infotrack.com.au/products/company-searches/credit-report/creditorwatch/",
      "displayLink": "www.infotrack.com.au",
      "snippet": "CreditorWatch Report. Credit reports provide insightful information to assist in \nyour assessment of defining how creditworthy a business in Australia is.",
      "htmlSnippet": "\u003cb\u003eCreditorWatch\u003c/b\u003e Report. Credit reports provide insightful information to assist in \u003cbr\u003e\nyour assessment of defining how creditworthy a business in Australia is.",
      "cacheId": "DPMjQJ8uZl8J",
      "formattedUrl": "https://www.infotrack.com.au/products/company-searches/.../creditorwatch/",
      "htmlFormattedUrl": "https://www.infotrack.com.au/products/company-searches/.../\u003cb\u003ecreditorwatch\u003c/b\u003e/",
      "pagemap": {
        "cse_thumbnail": [
          {
            "src": "https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRgsi9FD5THts7p2lgUS2BAgu3w2-tVS-TTHdjDHc7lnE9D-XFvTox-pEM3",
            "width": "225",
            "height": "225"
          }
        ],
        "BreadcrumbList": [
          {}
        ],
        "metatags": [
          {
            "og:image": "https://www.infotrack.com.au/wp-content/uploads/itk-logo-square.png",
            "og:type": "article",
            "twitter:card": "summary",
            "twitter:title": "CreditorWatch Credit Report | InfoTrack",
            "og:site_name": "InfoTrack",
            "msvalidate.01": "AA34DE94A92A3B15B07AAA51D7317398",
            "og:title": "CreditorWatch Credit Report | InfoTrack",
            "msapplication-tileimage": "https://www.infotrack.com.au/wp-content/uploads/cropped-infotrack-site-icon-270x270.png",
            "og:description": "This Credit Report will provide you with information to assist in assessment of defining how creditworthy any business in Australia is.",
            "twitter:creator": "@infotrack_aus",
            "article:publisher": "https://www.facebook.com/infotrackaus",
            "og:image:secure_url": "https://www.infotrack.com.au/wp-content/uploads/itk-logo-square.png",
            "twitter:image": "https://www.infotrack.com.au/wp-content/uploads/itk-logo-square.png",
            "twitter:site": "@infotrack_aus",
            "viewport": "width=device-width, initial-scale=1",
            "twitter:description": "This Credit Report will provide you with information to assist in assessment of defining how creditworthy any business in Australia is.",
            "og:locale": "en_US",
            "position": "1",
            "og:url": "https://www.infotrack.com.au/products/company-searches/credit-report/creditorwatch/"
          }
        ],
        "cse_image": [
          {
            "src": "https://www.infotrack.com.au/wp-content/uploads/itk-logo-square.png"
          }
        ]
      }
    }
  ]
}
JSON;
    }
}
