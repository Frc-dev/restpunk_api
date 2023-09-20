<?php

namespace App\Application\SearchByFields;

use App\Domain\Api\ApiRequest;
use App\Domain\SearchFields;
use App\Domain\Validator\FieldsValidator;
use App\Domain\Validator\SearchResponseValidator;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\DependencyInjection\Attribute\Target;
use Symfony\Contracts\Cache\ItemInterface;

class SearchByFields
{
    public function __construct(
        //this tells ApiRequest interface to implement the class defined in the services.yaml
        #[Target('app.api.punk')]
        private readonly ApiRequest $apiRequest,
        private readonly FieldsValidator $fieldsValidator,
        private readonly SearchResponseValidator $searchResponseValidator,
        private readonly FilesystemAdapter $cache
    ) {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function __invoke(SearchFields $fields): SearchByFieldsResponse
    {
        $this->fieldsValidator->validateFields($fields);

        $response = $this->getSearchByFieldsResponse($fields);

        $this->searchResponseValidator->validateSearchResponse($response);

        return $response;
    }

    /**
     * @param SearchFields $fields
     * @return SearchByFieldsResponse
     * @throws InvalidArgumentException
     */
    public function getSearchByFieldsResponse(SearchFields $fields): SearchByFieldsResponse
    {
        return $this->cache->get(
            'search_fields_cache',
            function (ItemInterface $item) use ($fields): SearchByFieldsResponse {
                $item->expiresAfter(3600);

                return $this->apiRequest->searchByFields($fields->toArray());
            }
        );
    }
}
