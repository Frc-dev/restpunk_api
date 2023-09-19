<?php

namespace App\Application\SearchByFields;

use App\Domain\Bus\Query\Query;

class SearchByFieldsQuery implements Query
{
    public function __construct(
        private readonly string $filters
    )
    {
    }

    public function getFilters(): string
    {
        return $this->filters;
    }
}