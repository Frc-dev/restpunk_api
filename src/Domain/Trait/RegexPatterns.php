<?php

namespace App\Domain\Trait;

trait RegexPatterns
{
    private string $onlyNumbers = '/^[0-9]+$/';
    private string $onlyAlphanumeric = '/^[a-zA-Z0-9 .\-]+$/';
}