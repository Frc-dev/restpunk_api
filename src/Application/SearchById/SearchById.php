<?php

namespace App\Application\SearchById;

use App\Domain\Api\ApiRequest;
use App\Domain\Validator\SearchResponseValidator;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\DependencyInjection\Attribute\Target;
use Symfony\Contracts\Cache\ItemInterface;

class SearchById
{
    public function __construct(
        //this tells ApiRequest interface to implement the class defined in the services.yaml
        #[Target('app.api.punk')]
        private readonly ApiRequest $apiRequest,
        private readonly SearchResponseValidator $searchResponseValidator,
        private readonly FilesystemAdapter $cache
    )
    {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function __invoke(int $id): SearchByIdResponse
    {
        $response = $this->getSearchByIdResponse($id);

        $this->searchResponseValidator->validateSearchResponse($response);

        return $response;
    }

    /**
     * @param int $id
     * @return SearchByIdResponse
     * @throws InvalidArgumentException
     */
    public function getSearchByIdResponse(int $id): SearchByIdResponse
    {
        return $this->cache->get(
            'search_id_cache',
            function (ItemInterface $item) use ($id): SearchByIdResponse {
                $item->expiresAfter(3600);

                return $this->apiRequest->searchById($id);
            }
        );
    }
}