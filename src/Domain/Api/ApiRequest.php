<?php

namespace App\Domain\Api;

use App\Application\SearchByFields\SearchByFieldsResponse;
use App\Application\SearchById\SearchByIdResponse;

interface ApiRequest
{
    public function searchByFields(array $fields): SearchByFieldsResponse;

    public function searchById(int $id): SearchByIdResponse;

    public function callApi(string $url, string $method): array;
}
