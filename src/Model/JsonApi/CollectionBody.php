<?php

declare(strict_types=1);

namespace App\Model\JsonApi;

use App\Model\JsonApi\Resource\Resource;

final class CollectionBody implements Body
{
    /**
     * @var Resource[]
     */
    public array $data;

    /**
     * @param Resource[] $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return Resource[]
     */
    public function getData(): array
    {
        return $this->data;
    }
}
