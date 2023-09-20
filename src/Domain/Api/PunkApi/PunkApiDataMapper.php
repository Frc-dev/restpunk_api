<?php

namespace App\Domain\Api\PunkApi;

use App\Application\SearchByFields\SearchByFieldsResponse;
use App\Application\SearchById\SearchByIdResponse;

class PunkApiDataMapper
{
    use PunkApiData;
    public function buildSearchByFieldsResponseFromApiResponse(array $apiResponse): SearchByFieldsResponse
    {
        $response = new SearchByFieldsResponse();

        return $this->setResponseParameters($apiResponse, $response);
    }

    public function buildSearchByIdResponseFromApiResponse(array $apiResponse): SearchByIdResponse
    {
        $response = new SearchByIdResponse();

        return $this->setResponseParameters($apiResponse, $response);
    }

    public function setResponseParameters(array $apiResponse, mixed $response): mixed
    {
        $response->setId($apiResponse[$this->apiId])
            ->setName($apiResponse[$this->apiName])
            ->setTagline($apiResponse[$this->apiTagline])
            ->setFirstBrewed($apiResponse[$this->apiFirstBrewed])
            ->setDescription($apiResponse[$this->apiDescription])
            ->setImage($apiResponse[$this->apiImage])
        ;

        return $response;
    }
}
