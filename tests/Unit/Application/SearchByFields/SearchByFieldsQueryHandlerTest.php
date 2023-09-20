<?php

namespace App\Tests\Unit\Application\SearchByFields;

use App\Application\SearchByFields\SearchByFields;
use App\Application\SearchByFields\SearchByFieldsQueryHandler;
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

        $this->shouldReturnValidFields($fields);
        $this->shouldSearchByFieldsAndReturnApiResponse($fields->toArray(), $result);
        $this->shouldReturnValidSearchResponse($result);

        $this->assertEquals($result, $this->handler->__invoke($query));
    }
}