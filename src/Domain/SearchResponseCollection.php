<?php

namespace App\Domain;

use App\Application\SearchResponse;
use ArrayIterator;
use IteratorAggregate;
use Traversable;

class SearchResponseCollection implements IteratorAggregate
{
    /** @var SearchResponse[] */
    private array $list = [];

    public function add(SearchResponse $response): void
    {
        $this->list[] = $response;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->list);
    }

    public function toArray(): array
    {
        $array = [];

        foreach (self::getIterator() as $item) {
            $array[] = $item->toArray();
        }

        return $array;
    }
}
