<?php

namespace App\Domain\Trait;

trait RegexPatterns
{
    private static string $numbers = '/^[0-9]+$/';
    private static string $alphanumeric = '/^[a-zA-ZÀ-ÖÙ-öù-ÿĀ-žḀ-ỿ0-9 ,.\'\-]+$/';
    private static string $date = '/^[0-9\/]+$/';
}