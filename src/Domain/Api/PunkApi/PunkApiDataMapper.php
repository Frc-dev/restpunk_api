<?php

namespace App\Domain\Api\PunkApi;

use App\Application\SearchByFields\SearchByFieldsResponse;
use App\Application\SearchById\SearchByIdResponse;
use App\Domain\SearchResponseCollection;

class PunkApiDataMapper
{
    use PunkApiData;

    public function buildSearchByFieldsResponse(array $apiResponseArray): SearchResponseCollection
    {
        $collection = new SearchResponseCollection();

        foreach ($apiResponseArray as $apiResponse) {
            $response = new SearchByFieldsResponse();
            $response = $this->setResponseParameters($apiResponse, $response);
            $collection->add($response);
        }

        return $collection;
    }

    public function buildSearchByIdResponse(array $apiResponseArray): SearchResponseCollection
    {
        $collection = new SearchResponseCollection();

        foreach ($apiResponseArray as $apiResponse) {
            $response = new SearchByIdResponse();
            $response = $this->setResponseParameters($apiResponse, $response);
            $collection->add($response);
        }

        return $collection;
    }

    public function setResponseParameters(
        array $apiResponse,
        mixed $response
    ): mixed {
        $response->setId($apiResponse[$this->apiId])
            ->setName($apiResponse[$this->apiName])
            ->setTagline($apiResponse[$this->apiTagline])
            ->setFirstBrewed($apiResponse[$this->apiFirstBrewed])
            ->setDescription($apiResponse[$this->apiDescription])
            ->setImage($apiResponse[$this->apiImage]);

        return $response;
    }
}
