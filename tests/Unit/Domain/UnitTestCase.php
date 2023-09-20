<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain;

use App\Domain\Api\ApiRequest;
use App\Domain\Validator\FieldsValidator;
use App\Domain\Validator\SearchResponseValidator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class UnitTestCase extends TestCase
{
    private $apiRequest;
    private $fieldsValidator;
    private $searchResponseValidator;
    private $filesystemAdapter;

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

    protected function filesystemAdapter(): MockObject | FilesystemAdapter
    {
        return $this->filesystemAdapter = $this->filesystemAdapter ?: $this->mock(FilesystemAdapter::class);
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
        $this->filesystemAdapter()
            ->expects(self::once())
            ->method('get')
            ->with('search_fields_cache')
            ->willReturn($result);
    }

    protected function shouldSearchByIdAndReturnApiResponse($id, $result): void
    {
        $this->filesystemAdapter()
            ->expects(self::once())
            ->method('get')
            ->with('search_id_cache')
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