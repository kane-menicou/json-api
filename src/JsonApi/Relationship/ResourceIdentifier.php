<?php

declare(strict_types=1);

namespace App\JsonApi\Relationship;

use App\JsonApi\AbstractResource;
use Symfony\Component\Validator\Constraints as Assert;

final class ResourceIdentifier extends AbstractResource
{
    #[Assert\Type('string')]
    public mixed $id = null;
}
