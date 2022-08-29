<?php

declare(strict_types=1);

namespace App\Controller\Api\V1;

use App\Controller\Api\AbstractJsonApiController;
use App\Model\JsonApi\Resource\Resource;
use App\Model\JsonApi\SingleBody;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use function var_dump;

final class PetController extends AbstractJsonApiController
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    #[Route('/api/pets', methods: ['POST'])]
    public function create(Request $request): Response
    {
        var_dump($request->getContentType());
        if ($request->getContentType() !== self::JSON_API_MIME_TYPE) {
            return $this->errorWithStatus(Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
        }

        if ($request->getAcceptableContentTypes() !== [self::JSON_API_MIME_TYPE]) {
            return $this->errorWithStatus(Response::HTTP_NOT_ACCEPTABLE);
        }

        /** @var SingleBody $body */
        $body = $this->container
            ->get('serializer')
            ->deserialize(
                $request->getContent(),
                SingleBody::class,
                'json',
            )
        ;

        $violations = $this->validator->validate($body, new Valid());
        if ($violations->count() > 0) {
            return $this->errorFromViolations($violations, Response::HTTP_BAD_REQUEST);
        }

        $body->validate();

        return $this->json($body);
    }

    public function view(): Response
    {
        return $this->json(
            new SingleBody(
                Resource::createValidated(
                    '991452c2-bec9-4410-8fba-f8efd073a36c',
                    'pet'
                ),
            ),
        );
    }

    public function list(): Response
    {
    }

    public function partialUpdate(): Response
    {
    }

    public function update(): Response
    {
    }
}
