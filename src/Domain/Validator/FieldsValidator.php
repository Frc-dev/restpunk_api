<?php

namespace App\Domain\Validator;

use App\Domain\DomainError\ValidationFailedException;
use App\Domain\SearchFields;
use App\Domain\Trait\Fields;
use App\Domain\Trait\RegexPatterns;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

class FieldsValidator
{
    use Fields;
    use RegexPatterns;

    public function __construct(
        private ValidatorInterface $validator
    ) {
        $this->validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    }

    public function validateFields(SearchFields $input): void
    {
        $input = $input->toArray();
        $constraints = new Assert\Collection([
            $this->fieldFood => [
                new Assert\NotBlank(),
                new Assert\Type('string'),
                new Assert\Regex(self::$alphanumeric),
            ],
        ]);

        $errors = $this->validator->validate($input, $constraints);

        if (count($errors) > 0) {
            throw new ValidationFailedException((string) $errors);
        }
    }
}
