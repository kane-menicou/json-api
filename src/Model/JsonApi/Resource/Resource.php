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

    public static function createValidated(string $id, string $type): self
    {
        $new = new self($id, $type);
        $new->validate();

        return $new;
    }

    // TODO: COULD PROPERTIES BE PRIVATE AND BE CONSTRUCTED BY DESERIALIZER.
    public function __construct(mixed $id, mixed $type)
    {
        $this->id = $id;
        $this->type = $type;
        $this->validated = false;
    }

    public function validate(): void
    {
        $this->validatedId = $this->id;
        $this->validatedType = $this->type;

        $this->validated = true;
    }
}
