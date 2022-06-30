<?php

namespace App\Constraints;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute(Attribute::TARGET_CLASS)]
class UniquePropertyConstraint extends Constraint
{
    public ?string $property = null;
    public array   $entities = [];
}