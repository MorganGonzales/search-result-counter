<?php

namespace App\Services\SearchEngines;

interface SearchEngine
{
    public function search(string $keyword, int $startIndex = 1): string;
}
