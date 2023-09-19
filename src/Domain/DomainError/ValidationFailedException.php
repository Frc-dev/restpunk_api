<?php

namespace App\Domain\DomainError;

class ValidationFailedException extends DomainError
{
    public function __construct(
        private readonly string $validation
    )
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return '400';
    }

    protected function errorMessage(): string
    {
        return sprintf('Validation has failed: %s', $this->validation);
    }
}