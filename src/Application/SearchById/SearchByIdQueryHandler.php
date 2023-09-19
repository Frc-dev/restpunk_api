<?php

namespace App\Application\SearchById;

use App\Domain\Bus\Query\QueryHandler;

class SearchByIdQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly SearchById $searchById
    )
    {
    }

    public function __invoke(SearchByIdQuery $searchByIdQuery): SearchByIdResponse
    {
        $id = $searchByIdQuery->getId();

        return $this->searchById->__invoke($id);
    }
}