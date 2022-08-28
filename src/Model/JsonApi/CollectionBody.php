<?php

declare(strict_types=1);

namespace App\Model\JsonApi;

use App\Model\JsonApi\Resource\Resource;

final class CollectionBody
{
    /**
     * @var Resource[]
     */
    public array $data;
}
