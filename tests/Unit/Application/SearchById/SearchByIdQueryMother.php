<?php

namespace App\Tests\Unit\Application\SearchById;

use App\Application\SearchById\SearchByIdQuery;

class SearchByIdQueryMother
{
    public static function create(int $id = 1): SearchByIdQuery
    {
        return new SearchByIdQuery(
            $id
        );
    }

    public static function withId(int $id): SearchByIdQuery
    {
        return self::create($id);
    }
}