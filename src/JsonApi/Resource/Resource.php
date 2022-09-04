<?php

declare(strict_types=1);

namespace App\JsonApi\Resource;

use App\JsonApi\Attribute\AttributeSetInterface;
use App\Validator\ValidResourceType;
use Symfony\Component\Validator\Constraints as Assert;

final class Resource
{
    #[Assert\Type(['string', 'null'])]
    public mixed $id = null;

    #[Assert\Type('string')]
    #[Assert\NotBlank]
    #[ValidResourceType]
    public mixed $type;

    #[Assert\Valid]
    public ?AttributeSetInterface $attributes = null;
}
