<?php

namespace App\Application\SearchByFields;

use App\Application\SearchResponseValidator;
use App\Domain\Api\ApiRequest;
use App\Domain\FieldsValidator;
use Symfony\Component\DependencyInjection\Attribute\Target;

class SearchByFields
{
    public function __construct(
        //this tells ApiRequest interface to implement the class defined in the services.yaml
        #[Target('app.api.punk')]
        private readonly ApiRequest $apiRequest,
        private readonly FieldsValidator $fieldsValidator,
        private readonly SearchResponseValidator $searchResponseValidator
    )
    {
    }

    public function __invoke(array $fields): SearchByFieldsResponse
    {
        $this->fieldsValidator->validate($fields);

        $response = $this->apiRequest->searchByFields($fields);

        $this->searchResponseValidator->validateSearchResponse($response);

        return $response;
    }
}