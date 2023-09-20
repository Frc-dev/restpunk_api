<?php

namespace App\Tests\Unit\Domain;

use App\Domain\SearchFields;

class SearchFieldsMother
{
    public static function create($fields): SearchFields
    {
        $response = new SearchFields();

        $response->setFood($fields['food']);

        return $response;
    }

    public static function withFood($food): SearchFields
    {
        //we can add more parameters and start them by default with valid values when needed
        $fields = [
            'food' => $food
        ];

        return self::create($fields);
    }
}