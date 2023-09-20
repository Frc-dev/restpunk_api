<?php

namespace App\Domain;

use App\Domain\Trait\RegexPatterns;

class SearchFields
{
    use RegexPatterns;
    private string $food;

    public function toArray(): array
    {
        return [
            'food' => $this->food,
        ];
    }

    public function getFood(): string
    {
        return $this->food;
    }

    public function setFood(string $food): self
    {
        $this->food = $food;

        return $this;
    }
}
