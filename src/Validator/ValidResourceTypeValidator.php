<?php

declare(strict_types=1);

namespace App\Validator;

use App\Registry\JsonApi\Attribute\AttributeSetAttributeRegistryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

use function in_array;

final class ValidResourceTypeValidator extends ConstraintValidator
{
    public function __construct(private readonly AttributeSetAttributeRegistryInterface $attributeRegistry)
    {
    }

    public function validate(mixed $value, Constraint $constraint)
    {
        if (in_array($value, $this->attributeRegistry->getTypes())) {
            return;
        }

        $this->context
            ->buildViolation($constraint->message)
            ->setCode(ValidResourceType::INVALID_RESOURCE_TYPE_ERROR)
            ->addViolation();
    }
}
