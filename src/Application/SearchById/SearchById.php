<?php

namespace App\Application\SearchById;

use App\Application\SearchResponseValidator;
use App\Domain\Api\ApiRequest;
use Symfony\Component\DependencyInjection\Attribute\Target;

class SearchById
{
    public function __construct(
        //this tells ApiRequest interface to implement the class defined in the services.yaml
        #[Target('app.api.punk')]
        private readonly ApiRequest $apiRequest,
        private readonly SearchResponseValidator $searchResponseValidator
    )
    {
    }

    public function __invoke(int $id): SearchByIdResponse
    {
        $response = $this->apiRequest->searchById($id);

        $this->searchResponseValidator->validateSearchResponse($response);

        return $response;
    }
}