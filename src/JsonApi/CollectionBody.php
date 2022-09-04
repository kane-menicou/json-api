<?php

declare(strict_types=1);

namespace App\JsonApi;

use App\JsonApi\Resource\Resource;

final class CollectionBody
{
    /**
     * @var Resource[]
     */
    public array $data;
}
