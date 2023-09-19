<?php

namespace App\Domain;

use App\Domain\DomainError\ValidationFailedException;
use App\Domain\Trait\Fields;
use App\Domain\Trait\RegexPatterns;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class FieldsValidator
{
    use Fields;
    use RegexPatterns;

    public function validate(mixed $input): void
    {
        $validator = Validation::createValidator();

        $constraint = new Assert\Collection([
            $this->fieldFood => [
                new Assert\NotBlank(),
                new Assert\Type(['type' => 'string']),
                new Assert\Regex(['pattern' => $this->onlyAlphanumeric])
            ]
        ]);

        $errors = $validator->validate($input, $constraint);

        if (!empty($errors->get(0))) {
            throw new ValidationFailedException($errors->get(0));
        }
    }
}