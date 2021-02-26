<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\GetUrlRankingsFromSearchResult;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.index', ['rankings' => []]);
    }

    public function search(SearchRequest $request)
    {
        $service = new GetUrlRankingsFromSearchResult($request->get('keyword'), $request->get('url'));
//        $rankings = $service->execute();

        $rankings = [
            [
                'rank' => '1st',
                'title' => 'CreditorWatch: Business Credit Scores and Company Checks',
                'link' => 'https://creditorwatch.com.au/',
            ],
            [
                'rank' => '3rd',
                'title' => 'Login - Company Credit Check Services - CreditorWatch',
                'link' => 'https://creditorwatch.com.au/login',
            ],
        ];

        return redirect()->route('search.index')->with('rankings', $rankings);
    }
}
