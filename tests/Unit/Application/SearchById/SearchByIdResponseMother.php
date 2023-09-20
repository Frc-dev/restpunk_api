<?php

namespace App\Tests\Unit\Application\SearchById;

use App\Application\SearchById\SearchByIdResponse;

class SearchByIdResponseMother
{
    public static function create(
        int $id,
        string $name,
        string $tagline,
        string $firstBrewed,
        string $description,
        string $image
    ): SearchByIdResponse
    {
        $response = new SearchByIdResponse();

        $response->setId($id)
            ->setName($name)
            ->setTagline($tagline)
            ->setFirstBrewed($firstBrewed)
            ->setDescription($description)
            ->setImage($image);

        return $response;
    }

    public static function default(): SearchByIdResponse
    {
        //mother should resemble as closely as possible real data, so we use a response from real API
        return self::create(
            192,
            'Punk IPA 2007 - 2010',
            'Post Modern Classic. Spiky. Tropical. Hoppy.',
            '04/2007',
            'Our flagship beer that kick started the craft beer revolution. This is James and Martin\'s original take on an American IPA, subverted with punchy New Zealand hops.',
            'https://images.punkapi.com/v2/192.png'
        );
    }
}