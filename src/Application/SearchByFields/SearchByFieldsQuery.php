<?php

namespace App\Application\SearchByFields;

use App\Domain\Bus\Query\Query;
use App\Domain\SearchFields;

class SearchByFieldsQuery implements Query
{
    public function __construct(
        private readonly SearchFields $fields
    ) {
    }

    public function getFields(): SearchFields
    {
        return $this->fields;
    }
}
