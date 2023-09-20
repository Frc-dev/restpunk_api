<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain;

use App\Domain\Api\ApiRequest;
use App\Domain\Validator\FieldsValidator;
use App\Domain\Validator\SearchResponseValidator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UnitTestCase extends TestCase
{
    private $apiRequest;
    private $fieldsValidator;
    private $searchResponseValidator;

    protected function mock(string $className): MockObject
    {
        return $this->createMock($className);
    }

    protected function apiRequest(): MockObject | ApiRequest
    {
        return $this->apiRequest = $this->apiRequest ?: $this->mock(ApiRequest::class);
    }

    protected function fieldsValidator(): MockObject | FieldsValidator
    {
        return $this->fieldsValidator = $this->fieldsValidator ?: $this->mock(FieldsValidator::class);
    }

    protected function searchResponseValidator(): MockObject | SearchResponseValidator
    {
        return $this->searchResponseValidator = $this->searchResponseValidator ?: $this->mock(SearchResponseValidator::class);
    }

    protected function shouldReturnValidFields($result): void
    {
        $this->fieldsValidator()
            ->expects(self::once())
            ->method('validateFields')
            ->with($result);
    }

    protected function shouldSearchByFieldsAndReturnApiResponse($fields, $result): void
    {
        $this->apiRequest()
            ->expects(self::once())
            ->method('searchByFields')
            ->with($fields)
            ->willReturn($result);
    }

    protected function shouldSearchByIdAndReturnApiResponse($id, $result): void
    {
        $this->apiRequest()
            ->expects(self::once())
            ->method('searchById')
            ->with($id)
            ->willReturn($result);
    }

    protected function shouldReturnValidSearchResponse($result): void
    {
        $this->searchResponseValidator()
            ->expects(self::once())
            ->method('validateSearchResponse')
            ->with($result);
    }
}