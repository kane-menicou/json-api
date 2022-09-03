<?php

declare(strict_types=1);

namespace App\JsonApi;

use App\JsonApi\Resource\Resource;

interface Body
{
    /**
     * @return Resource|Resource[]
     */
    public function getData(): Resource|array;
}
