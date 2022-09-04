<?php

declare(strict_types=1);

namespace App\JsonApi\RelationshipSet;

use App\JsonApi\Relationship\ResourceIdentifier;

class PetRelationshipSet implements RelationshipSetInterface
{
    public ?ResourceIdentifier $person = null;
}
