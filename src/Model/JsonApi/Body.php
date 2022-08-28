<?php

declare(strict_types=1);

namespace App\Model\JsonApi;

use App\Model\JsonApi\Resource\Resource;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Valid;

final class Body
{
    #[Valid]
    #[NotBlank]
    public Resource $data;

    public function validate(): void
    {
        $this->data->validate();
    }
}
