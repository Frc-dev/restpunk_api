<?php

namespace App\Tests\Unit\Application\SearchById;

use App\Application\SearchById\SearchById;
use App\Application\SearchById\SearchByIdQueryHandler;
use App\Domain\SearchResponseCollection;
use App\Tests\Unit\Application\SearchById\SearchByIdQueryMother;
use App\Tests\Unit\Domain\UnitTestCase;

class SearchByIdQueryHandlerTest extends UnitTestCase
{
    private SearchByIdQueryHandler $handler;

    public function setUp(): void
    {
        parent::setUp();

        $this->handler = new SearchByIdQueryHandler(
            new SearchById(
                $this->apiRequest(),
                $this->searchResponseValidator(),
                $this->filesystemAdapter()
            )
        );
    }

    //there is no external behavior other than mocked dependencies and so test only works as a coverage test
    /** @test */
    public function test_return_search_response_from_query()
    {
        $query = SearchByIdQueryMother::create();
        $result = SearchByIdResponseMother::default();
        $collection = new SearchResponseCollection();
        $collection->add($result);

        $this->shouldSearchByIdAndReturnApiResponse($query->getId(), $collection);
        $this->shouldReturnValidSearchResponse($result);

        $this->assertEquals($collection->toArray(), $this->handler->__invoke($query));
    }
}