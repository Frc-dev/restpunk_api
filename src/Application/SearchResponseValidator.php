<?php

namespace App\Application;

use App\Domain\DomainError\ValidationFailedException;
use App\Domain\Trait\RegexPatterns;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class SearchResponseValidator
{
    use SearchResponseParameters;
    use RegexPatterns;

    public function validateSearchResponse(SearchResponse $response): void
    {
        $validator = Validation::createValidator();

        $constraint = new Assert\Collection([
            $this->id => [
                new Assert\Type(['type' => 'integer']),
                new Assert\Regex(['pattern' => $this->onlyNumbers])
            ],
            $this->name => [
                new Assert\Regex(['pattern' => $this->onlyAlphanumeric])
            ],
            $this->tagline => [
                new Assert\Regex(['pattern' => $this->onlyAlphanumeric])
            ],
            $this->firstBrewed => [
                new Assert\Date()
            ],
            $this->description => [
                new Assert\Regex(['pattern' => $this->onlyAlphanumeric])
            ],
            $this->image => [
                new Assert\Image()
            ]
        ]);

        $errors = $validator->validate($response, $constraint);

        if (!empty($errors->get(0)))
        {
            throw new ValidationFailedException($errors->get(0));
        }
    }
}