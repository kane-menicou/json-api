<?php

declare(strict_types=1);

namespace App\JsonApi\Attribute;

use App\Attribute\JsonApi\AttributeSet;
use Symfony\Component\Validator\Constraints as Assert;

#[AttributeSet('pets')]
final class PetAttributeSet implements AttributeSetInterface
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public mixed $name;
}
