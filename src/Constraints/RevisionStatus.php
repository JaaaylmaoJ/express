<?php

namespace App\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

#[\Attribute(\Attribute::TARGET_CLASS)]
class RevisionStatus extends Constraint
{

    public string $message = 'Невозможно выполнить действие для ревизии в текущем статусе.';

    /**
     * true - статус ревизии должен быть одним из указанных статусов
     * false  - статус ревизии НЕ должен быть одним из указанных статусов
     */
    public bool $contains = false;

    public array $statuses = [];

    public function getTargets(): array
    {
        return [
            self::CLASS_CONSTRAINT,
            self::PROPERTY_CONSTRAINT
        ];
    }
}