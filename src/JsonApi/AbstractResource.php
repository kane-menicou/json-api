<?php

declare(strict_types=1);

namespace App\JsonApi;

use App\Validator\ValidResourceType;
use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractResource
{
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    #[ValidResourceType]
    public mixed $type;

}
