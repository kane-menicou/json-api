<?php

declare(strict_types=1);

namespace App\Model\JsonApi\Resource;

use DomainException;
use Symfony\Component\Serializer\Annotation as Serialiser;
use Symfony\Component\Validator\Constraints as Assert;

use function sprintf;

final class Resource
{
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    public mixed $id;

    #[Serialiser\Ignore]
    private string $validatedId;

    #[Assert\Type('string')]
    #[Assert\NotBlank]
    public mixed $type;

    #[Serialiser\Ignore]
    private string $validatedType;

    #[Serialiser\Ignore]
    private bool $validated = false;

    public function validate(): void
    {
        $this->validatedId = $this->id;
        $this->validatedType = $this->type;

        $this->validated = true;
    }

    public function getId(): string
    {
        if (! $this->validated) {
            throw new DomainException(sprintf("Cannot call '%s' on unvalidated'", __METHOD__));
        }

        return $this->validatedId;
    }

    public function getType(): string
    {
        if (! $this->validated) {
            throw new DomainException(sprintf("Cannot call '%s' when unvalidated", __METHOD__));
        }

        return $this->validatedType;
    }
}
