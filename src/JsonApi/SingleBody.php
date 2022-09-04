<?php

declare(strict_types=1);

namespace App\JsonApi;

use App\JsonApi\Resource\Resource;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Valid;

final class SingleBody
{
    #[Valid]
    #[NotBlank]
    public Resource $data;
}
