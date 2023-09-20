<?php

namespace App\Application\SearchByFields;

use App\Domain\Api\ApiRequest;
use App\Domain\SearchFields;
use App\Domain\SearchResponseCollection;
use App\Domain\Validator\FieldsValidator;
use App\Domain\Validator\SearchResponseValidator;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class SearchByFields
{
    public function __construct(
        //this tells ApiRequest interface to implement the class defined in the services.yaml
        #[Autowire(service: 'app.api.punk')]
        private readonly ApiRequest $apiRequest,
        private readonly FieldsValidator $fieldsValidator,
        private readonly SearchResponseValidator $searchResponseValidator,
        private readonly CacheInterface $cache
    ) {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function __invoke(SearchFields $fields): SearchResponseCollection
    {
        $this->fieldsValidator->validateFields($fields);

        $response = $this->getSearchByFieldsResponse($fields);

        foreach ($response as $item) {
            $this->searchResponseValidator->validateSearchResponse($item);
        }

        return $response;
    }

    /**
     * @param SearchFields $fields
     * @return SearchResponseCollection
     * @throws InvalidArgumentException
     */
    public function getSearchByFieldsResponse(SearchFields $fields): SearchResponseCollection
    {
        return $this->cache->get(
            'search_fields_cache:' . json_encode($fields->toArray()),
            function (ItemInterface $item) use ($fields): SearchResponseCollection {
                $item->set($fields);
                $item->expiresAfter(3600);

                return $this->apiRequest->searchByFields($fields->toArray());
            }
        );
    }
}
