<?php

namespace App\Tests\Unit\Application\SearchByFields;

use App\Application\SearchByFields\SearchByFieldsResponse;

class SearchByFieldsResponseMother
{
    public static function create(
        int $id,
        string $name,
        string $tagline,
        string $firstBrewed,
        string $description,
        string $image
    ): SearchByFieldsResponse
    {
        $response = new SearchByFieldsResponse();

        $response->setId($id)
            ->setName($name)
            ->setTagline($tagline)
            ->setFirstBrewed($firstBrewed)
            ->setDescription($description)
            ->setImage($image);

        return $response;
    }

    public static function default(): SearchByFieldsResponse
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

    public static function withName(string $name): SearchByFieldsResponse
    {
        //mother should resemble as closely as possible real data, so we use a response from real API
        return self::create(
            192,
            $name,
            'Post Modern Classic. Spiky. Tropical. Hoppy.',
            '04/2007',
            'Our flagship beer that kick started the craft beer revolution. This is James and Martin\'s original take on an American IPA, subverted with punchy New Zealand hops.',
            'https://images.punkapi.com/v2/192.png'
        );
    }

    public static function withTagline(string $tagline): SearchByFieldsResponse
    {
        //mother should resemble as closely as possible real data, so we use a response from real API
        return self::create(
            192,
            'Punk IPA 2007 - 2010',
            $tagline,
            '04/2007',
            'Our flagship beer that kick started the craft beer revolution. This is James and Martin\'s original take on an American IPA, subverted with punchy New Zealand hops.',
            'https://images.punkapi.com/v2/192.png'
        );
    }

    public static function withFirstBrewed(string $firstBrewed): SearchByFieldsResponse
    {
        //mother should resemble as closely as possible real data, so we use a response from real API
        return self::create(
            192,
            'Punk IPA 2007 - 2010',
            'Post Modern Classic. Spiky. Tropical. Hoppy.',
            $firstBrewed,
            'Our flagship beer that kick started the craft beer revolution. This is James and Martin\'s original take on an American IPA, subverted with punchy New Zealand hops.',
            'https://images.punkapi.com/v2/192.png'
        );
    }

    public static function withDescription(string $description): SearchByFieldsResponse
    {
        //mother should resemble as closely as possible real data, so we use a response from real API
        return self::create(
            192,
            'Punk IPA 2007 - 2010',
            'Post Modern Classic. Spiky. Tropical. Hoppy.',
            '04/2007',
            $description,
            'https://images.punkapi.com/v2/192.png'
        );
    }

    public static function withImage(string $image): SearchByFieldsResponse
    {
        //mother should resemble as closely as possible real data, so we use a response from real API
        return self::create(
            192,
            'Punk IPA 2007 - 2010',
            'Post Modern Classic. Spiky. Tropical. Hoppy.',
            '04/2007',
            'Our flagship beer that kick started the craft beer revolution. This is James and Martin\'s original take on an American IPA, subverted with punchy New Zealand hops.',
            $image
        );
    }
}