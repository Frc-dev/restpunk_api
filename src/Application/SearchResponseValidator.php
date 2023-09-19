<?php

namespace App\Application;

use App\Domain\DomainError\ValidationFailedException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class SearchResponseValidator
{
    use SearchResponseParameters;
    public function validateSearchResponse(SearchResponse $response): void
    {
        $validator = Validation::createValidator();

        $constraint = new Assert\Collection([
            $this->id => [
                new Assert\Type(['type' => 'integer']),
                new Assert\Regex(['pattern' => '/^[0-9]+$/'])
            ],
            $this->name => [

            ],
            $this->tagline => [

            ],
            $this->firstBrewed => [

            ],
            $this->description => [

            ],
            $this->image => [

            ]
        ]);

        $errors = $validator->validate($response, $constraint);

        if (!empty($errors->get(0)))
        {
            throw new ValidationFailedException($errors->get(0));
        }
    }
}