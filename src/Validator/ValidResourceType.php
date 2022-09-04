<?php

declare(strict_types=1);

namespace App\Validator;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
final class ValidResourceType extends Constraint
{
    public const INVALID_RESOURCE_TYPE_ERROR = '3fc09ba4-65ce-4d06-aacd-25f4d9be5b36';

    public string $message = 'This value must be a valid resource type.';
}
