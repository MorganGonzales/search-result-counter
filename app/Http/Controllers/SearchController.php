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
        $rankings = app(GetUrlRankingsFromSearchResult::class)
            ->execute($request->get('keyword'), $request->get('url'));

        return redirect()
            ->route('search.index')
            ->with('rankings', $rankings);
    }
}
