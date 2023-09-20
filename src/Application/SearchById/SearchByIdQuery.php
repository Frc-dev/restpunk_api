<?php

namespace App\Application\SearchById;

use App\Domain\Bus\Query\Query;

class SearchByIdQuery implements Query
{
    public function __construct(
        private readonly int $id
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
