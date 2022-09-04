<?php

declare(strict_types=1);

namespace App\JsonApi\Resource;

use App\JsonApi\AbstractResource;
use App\JsonApi\AttributeSet\AttributeSetInterface;
use App\JsonApi\RelationshipSet\RelationshipSetInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class Resource extends AbstractResource
{
    #[Assert\Type(['string', 'null'])]
    public mixed $id = null;

    #[Assert\Valid]
    #[Assert\NotBlank]
    public AttributeSetInterface $attributes;

//    #[Assert\Valid]
//    #[Assert\NotBlank]
//    public RelationshipSetInterface $relationships;
}
