<?php

namespace App\Application\SearchById;

use App\Domain\Api\ApiRequest;
use App\Domain\SearchResponseCollection;
use App\Domain\Validator\SearchResponseValidator;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class SearchById
{
    public function __construct(
        //this tells ApiRequest interface to implement the class defined in the services.yaml
        #[Autowire(service: 'app.api.punk')]
        private readonly ApiRequest $apiRequest,
        private readonly SearchResponseValidator $searchResponseValidator,
        private readonly CacheInterface $cache
    ) {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function __invoke(int $id): SearchResponseCollection
    {
        $response = $this->getSearchByIdResponse($id);

        foreach ($response as $item) {
            $this->searchResponseValidator->validateSearchResponse($item);
        }

        return $response;
    }

    /**
     * @param int $id
     * @return SearchResponseCollection
     * @throws InvalidArgumentException
     */
    public function getSearchByIdResponse(int $id): SearchResponseCollection
    {
        return $this->cache->get(
            'search_id_cache:' . json_encode($id),
            function (ItemInterface $item) use ($id): SearchResponseCollection {
                $item->expiresAfter(3600);

                return $this->apiRequest->searchById($id);
            }
        );
    }
}
