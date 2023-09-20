<?php

namespace App\Tests\Unit\Application\SearchByFields;

use App\Application\SearchByFields\SearchByFieldsQuery;
use App\Domain\SearchFields;

class SearchByFieldsQueryMother
{
    public static function create(SearchFields $fields): SearchByFieldsQuery
    {
        return new SearchByFieldsQuery(
            $fields
        );
    }

    public static function withFields(SearchFields $fields): SearchByFieldsQuery
    {
        return self::create($fields);
    }
}
