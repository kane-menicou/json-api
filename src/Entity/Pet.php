<?php

declare(strict_types=1);

namespace App\Entity;

class Pet
{
    public function __construct(private readonly string $id, private string $name)
    {
    }
}
