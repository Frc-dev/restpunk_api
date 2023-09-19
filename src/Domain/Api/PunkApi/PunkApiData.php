<?php

namespace App\Domain\Api\PunkApi;

trait PunkApiData
{
    private string $baseApiUrl = 'https://api.punkapi.com/v2/ ';
    private string $baseBeersUrl = 'beers';

    //fields as we define in controller do not have to match the ones used in the API
    private array $apiFields = [
        'food'
    ];

    private string $apiId = 'id';
    private string $apiName = 'name';
    private string $apiTagline = 'tagline';
    private string $apiFirstBrewed = 'first_brewed';
    private string $apiDescription = 'description';
    private string $apiImage = 'image';
}