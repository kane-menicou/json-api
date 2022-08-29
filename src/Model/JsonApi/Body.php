<?php

declare(strict_types=1);

namespace App\Model\JsonApi;

use App\Model\JsonApi\Resource\Resource;

interface Body
{
    /**
     * @return Resource|Resource[]
     */
    public function getData(): Resource|array;
}
