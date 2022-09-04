<?php

declare(strict_types=1);

namespace App\Serializer;

use App\Exception\Registry\JsonApi\AttributeRegistryInterface\NotFoundException;
use App\JsonApi\AttributeSet\AttributeSetInterface;
use App\JsonApi\AttributeSet\LateInitialisedAttributeSetInterface;
use App\JsonApi\Resource\Resource;
use App\Registry\JsonApi\Attribute\AttributeSetAttributeRegistryInterface;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

final class AttributeSetDenormaliser implements DenormalizerInterface
{
    public function __construct(
        private readonly ObjectNormalizer $denormalizer,
        private readonly AttributeSetAttributeRegistryInterface $registry
    ) {
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        if ($type === AttributeSetInterface::class) {
            return new LateInitialisedAttributeSetInterface();
        }

        /** @var Resource $resource */
        $resource = $this->denormalizer->denormalize($data, $type, $format, $context);

        if (isset($resource->attributes) && $resource->attributes instanceof LateInitialisedAttributeSetInterface) {
            try {
                $class = $this->registry->getAttributeSetClassForType($resource->type);
            } catch (NotFoundException) {
                unset($resource->attributes);

                return $resource;
            }

            $resource->attributes = $this->denormalizer->denormalize($data['attributes'], $class, $format, $context);
        }

        return $resource;
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return
            $type === Resource::class
            || $type === AttributeSetInterface::class;
    }
}
