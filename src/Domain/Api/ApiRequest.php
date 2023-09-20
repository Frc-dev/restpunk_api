<?php

namespace App\Domain\Api;

use App\Domain\SearchResponseCollection;

interface ApiRequest
{
    public function searchByFields(array $fields): SearchResponseCollection;

    public function searchById(int $id): SearchResponseCollection;

    public function callApi(string $url, string $method): array;
}
