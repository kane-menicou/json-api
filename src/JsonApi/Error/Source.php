<?php

declare(strict_types=1);

namespace App\JsonApi\Error;

final class Source
{
    public function __construct(
        /**
         * @var string|null a JSON Pointer [RFC6901] to the associated entity in the request document [e.g. "/data" for
         * a primary data object, or "/data/attributes/title" for a specific attribute].
         */
        public readonly ?string $pointer = null,
        /**
         * @var string|null indicating which URI query parameter caused the error.
         */
        public readonly ?string $parameter = null,
    ) {
    }
}
