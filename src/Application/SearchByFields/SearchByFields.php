<?php

namespace App\Application\SearchByFields;

use App\Domain\Api\ApiRequest;
use App\Domain\SearchFields;
use App\Domain\Validator\FieldsValidator;
use App\Domain\Validator\SearchResponseValidator;
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

    public function __invoke(SearchFields $fields): SearchByFieldsResponse
    {
        $this->fieldsValidator->validateFields($fields);

        $response = $this->apiRequest->searchByFields($fields->toArray());

        $this->searchResponseValidator->validateSearchResponse($response);

        return $response;
    }
}