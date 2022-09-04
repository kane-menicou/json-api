<?php

declare(strict_types=1);

namespace App\JsonApi\Error;

/**
 * @see https://jsonapi.org/format/#error-objects
 */
final class Error
{
    public function __construct(
        /**
         * @var string|null a unique identifier for this particular occurrence of the problem.
         */
        public readonly ?string $id = null,
        public readonly ?Links $links = null,
        /**
         * @var string|null the HTTP status code applicable to this problem, expressed as a string value.
         */
        public readonly ?string $status = null,
        /**
         * @var string|null an application-specific error code, expressed as a string value.
         */
        public readonly ?string $code = null,
        /**
         * @var string|null a short, human-readable summary of the problem that SHOULD NOT change from occurrence to
         * occurrence of the problem, except for purposes of localization.
         */
        public readonly ?string $title = null,
        /**
         * @var string|null a human-readable explanation specific to this occurrence of the problem. Like title, this
         * field’s value can be localized.
         */
        public readonly ?string $detail = null,
        /**
         * @var Source|null an object containing references to the source of the error.
         */
        public readonly ?Source $source = null,
        /**
         * @var array|null a meta object containing non-standard meta-information about the error.
         */
        public readonly ?array $meta = null,
    ) {
    }
}
