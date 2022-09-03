<?php

declare(strict_types=1);

namespace App\JsonApi;

use App\JsonApi\Resource\Resource;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Valid;

final class SingleBody implements Body
{
    #[Valid]
    #[NotBlank]
    public Resource $data;

    public function __construct(Resource $data)
    {
        $this->data = $data;
    }

    public function validate(): void
    {
        $this->data->validate();
    }

    public function getData(): Resource
    {
        return $this->data;
    }
}
