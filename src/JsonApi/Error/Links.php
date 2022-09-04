<?php

declare(strict_types=1);

namespace App\JsonApi\Error;

final class Links
{
    public function __construct(
        /**
         * @var string|null a link that leads to further details about this particular occurrence of the problem.
         */
        public readonly ?string $about = null,
    ) {
    }
}
