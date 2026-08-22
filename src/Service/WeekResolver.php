<?php

namespace App\Service;

use DateTimeImmutable;

final class WeekResolver
{
    public function resolve(string $week = ''): DateTimeImmutable
    {
        if ('' === $week) {
            return new DateTimeImmutable('monday this week');
        }

        $selectedDate = DateTimeImmutable::createFromFormat('!Y-m-d', $week);
        $errors = DateTimeImmutable::getLastErrors();
        if (false === $selectedDate || (false !== $errors && (0 < $errors['warning_count'] || 0 < $errors['error_count']))) {
            return new DateTimeImmutable('monday this week');
        }

        return $selectedDate->modify('monday this week');
    }
}
