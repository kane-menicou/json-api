<?php

declare(strict_types=1);

namespace App\Registry\JsonApi\Attribute;

use App\Attribute\JsonApi\AttributeSet;
use App\Exception\Registry\JsonApi\AttributeRegistryInterface\NotFoundException;
use App\JsonApi\Attribute\PetAttributeSet;
use ReflectionClass;

use function array_key_exists;
use function array_key_first;
use function array_keys;

final class ReflectionAttributeSetAttributeRegistry implements AttributeSetAttributeRegistryInterface
{
    public function getAttributeSetClassForType(string $type): string
    {
        $typesClasses = $this->getTypesForClasses();
        if (! array_key_exists($type, $typesClasses)) {
            throw new NotFoundException();
        }

        return $typesClasses[$type];
    }

    public function getTypes(): array
    {
        return array_keys($this->getTypesForClasses());
    }

    private function getTypesForClasses(): array
    {
        $typesForClasses = [];
        // TODO: LOAD LIST SOMEHOW
        foreach ([PetAttributeSet::class] as $declaredClass) {
            $reflectionClass = new ReflectionClass($declaredClass);
            $attributes = $reflectionClass->getAttributes(AttributeSet::class);

            $attributeKey = array_key_first($attributes);
            if ($attributeKey !== null) {
                $instance = $attributes[$attributeKey]->newInstance();
                $typesForClasses[$instance->getType()] = $reflectionClass->getName();
            }
        }

        return $typesForClasses;
    }
}
