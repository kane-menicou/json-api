<?php

declare(strict_types=1);

namespace App\Attribute\JsonApi;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
final class AttributeSet
{
    public function __construct(private string $type)
    {
    }

    public function getType(): string
    {
        return $this->type;
    }
}
