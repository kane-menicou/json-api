<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\JsonApi\Error\Error;
use App\JsonApi\Error\Source;
use App\JsonApi\SingleBody;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Contracts\Translation\TranslatorInterface;

use function array_merge;
use function str_replace;

abstract class AbstractJsonApiController extends AbstractController
{
    protected const JSON_API_MIME_TYPE = 'application/vnd.api+json';

    public function __construct(protected readonly TranslatorInterface $translator)
    {
    }

    /**
     * @return Error[]
     */
    protected function violationsToErrors(
        ConstraintViolationList $violations,
        int $status = Response::HTTP_BAD_REQUEST
    ): array {
        $errors = [];
        foreach ($violations as $violation) {
            $errors[] = new Error(
                title: $this->translator->trans('api.v1.validationError.title'),
                detail: $violation->getMessage(),
                status: ((string)$status),
                code: $violation->getCode(),
                source: new Source(
                    pointer: $this->convertPhpPathToRfc6901($violation->getPropertyPath()),
                ),
            );
        }

        return $errors;
    }

    protected function convertPhpPathToRfc6901(string $phpPath): string
    {
        $withoutArrayEndChar = str_replace(']', '', $phpPath);
        $withSlashes = str_replace(['[', '.'], '/', $withoutArrayEndChar);

        return '/' . $withSlashes;
    }

    protected function errorForStatus(int $status): Error
    {
        return new Error(
            status: ((string)$status),
            title: Response::$statusTexts[$status],
        );
    }

    /**
     * @param Error[] $errors
     */
    protected function error(array $errors, int $status = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return $this->json(
            [
                'errors' => $errors,
            ],
            $status,
        );
    }

    /**
     * @throws NotEncodableValueException
     */
    protected function decodeForSingleResource(mixed $content): SingleBody
    {
        /** @var SingleBody $body */
        $body = $this->container
            ->get('serializer')
            ->deserialize(
                $content,
                SingleBody::class,
                'json',
            );

        return $body;
    }

    protected function json(
        mixed $data,
        int $status = Response::HTTP_OK,
        array $headers = [],
        array $context = [],
    ): JsonResponse {
        $headers = array_merge(
            [
                'Content-Type' => self::JSON_API_MIME_TYPE,
            ],
            $headers,
        );

        $context = array_merge(
            $context,
            [
                AbstractObjectNormalizer::SKIP_NULL_VALUES => true,
            ],
        );

        return parent::json($data, $status, $headers, $context);
    }
}
