<?php

namespace App\Tests\Unit\Application\SearchByFields;

use App\Application\SearchByFields\SearchByFields;
use App\Application\SearchByFields\SearchByFieldsQueryHandler;
use App\Domain\SearchResponseCollection;
use App\Tests\Unit\Domain\SearchFieldsMother;
use App\Tests\Unit\Domain\UnitTestCase;

class SearchByFieldsQueryHandlerTest extends UnitTestCase
{
    private SearchByFieldsQueryHandler $handler;

    public function setUp(): void
    {
        parent::setUp();

        $this->handler = new SearchByFieldsQueryHandler(
            new SearchByFields(
                $this->apiRequest(),
                $this->fieldsValidator(),
                $this->searchResponseValidator(),
                $this->filesystemAdapter(),
            )
        );
    }

    //here is no external behavior other than mocked dependencies and so test only works as a coverage test
    /** @test */
    public function should_return_search_response_from_query()
    {
        $fields = SearchFieldsMother::withFood('taco');
        $query = SearchByFieldsQueryMother::withFields($fields);
        $result = SearchByFieldsResponseMother::default();
        $collection = new SearchResponseCollection();
        $collection->add($result);

        $this->shouldReturnValidFields($fields);
        $this->shouldSearchByFieldsAndReturnApiResponse($fields->toArray(), $collection);
        $this->shouldReturnValidSearchResponse($result);

        $this->assertEquals($collection->toArray(), $this->handler->__invoke($query));
    }
}