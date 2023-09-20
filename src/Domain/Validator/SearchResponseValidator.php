<?php

namespace App\Domain\Validator;

use App\Application\SearchResponse;
use App\Domain\DomainError\ValidationFailedException;
use App\Domain\Trait\RegexPatterns;
use App\Domain\Trait\SearchResponseParameters;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SearchResponseValidator
{
    use SearchResponseParameters;
    use RegexPatterns;

    public function __construct(
        private ValidatorInterface $validator
    ) {
        $this->validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    }

    public function validateSearchResponse(SearchResponse $response): void
    {
        $response = $response->toArray();
        $constraint = new Assert\Collection([
            $this->id => [
                new Assert\Type('integer'),
                new Assert\Regex(['pattern' => self::$numbers]),
            ],
            $this->name => [
                new Assert\Regex(['pattern' => self::$alphanumeric]),
            ],
            $this->tagline => [
                new Assert\Regex(['pattern' => self::$alphanumeric]),
            ],
            $this->firstBrewed => [
                new Assert\Regex(['pattern' => self::$date]),
            ],
            $this->description => [
                new Assert\Regex(['pattern' => self::$alphanumeric]),
            ],
            $this->image => [
                new Assert\Url(),
            ],
        ]);

        $errors = $this->validator->validate($response, $constraint);

        if (count($errors) > 0) {
            throw new ValidationFailedException((string) $errors);
        }
    }
}
