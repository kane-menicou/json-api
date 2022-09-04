<?php

declare(strict_types=1);

namespace App\Registry\JsonApi\Attribute;

use App\Exception\Registry\JsonApi\AttributeRegistryInterface\NotFoundException;

interface AttributeSetAttributeRegistryInterface
{
    /**
     * @return class-string
     *
     * @throws NotFoundException
     */
    public function getAttributeSetClassForType(string $type): string;

    /**
     * @return list<string>
     */
    public function getTypes(): array;
}
