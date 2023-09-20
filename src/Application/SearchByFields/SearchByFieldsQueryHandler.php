<?php

namespace App\Application\SearchByFields;

use App\Domain\Bus\Query\QueryHandler;

class SearchByFieldsQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly SearchByFields $searchByFields
    ) {
    }

    public function __invoke(SearchByFieldsQuery $searchByFieldsQuery): array
    {
        $fields = $searchByFieldsQuery->getFields();

        return $this->searchByFields->__invoke($fields)->toArray();
    }
}
