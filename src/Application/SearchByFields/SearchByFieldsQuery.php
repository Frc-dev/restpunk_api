<?php

namespace App\Application\SearchByFields;

use App\Domain\Bus\Query\Query;

class SearchByFieldsQuery implements Query
{
    public function __construct(
        private readonly array $fields
    )
    {
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}