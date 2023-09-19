<?php

namespace App\Application\SearchByFields;

use App\Domain\Api\ApiRequest;
use App\Domain\FieldsValidator;

class SearchByFields
{
    public function __construct(
        private readonly ApiRequest $apiRequest,
        private readonly FieldsValidator $fieldsValidator
    )
    {
    }

    public function __invoke(array $fields): SearchByFieldsResponse
    {
        $this->fieldsValidator->validate($fields);
        $response = $this->apiRequest->searchByFields($fields);
        $this->fieldsValidator->validateSearchResponse($response);

        return $response;
    }
}