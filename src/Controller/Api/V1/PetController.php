<?php

declare(strict_types=1);

namespace App\Controller\Api\V1;

use App\Controller\Api\AbstractJsonApiController;
use App\JsonApi\Resource\Resource;
use App\JsonApi\SingleBody;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/pets')]
final class PetController extends AbstractJsonApiController
{
    public function __construct(private readonly ValidatorInterface $validator, TranslatorInterface $translator)
    {
        parent::__construct($translator);
    }

    #[Route(methods: ['POST'])]
    public function create(Request $request): Response
    {
        if ($request->headers->get('content-type') !== self::JSON_API_MIME_TYPE) {
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
            return $this->errorFromViolations($violations);
        }

        $body->validate();

        return $this->json($body);
    }

    #[Route('/{id}', methods: ['GET'])]
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

    #[Route(methods: ['GET'])]
    public function list(): Response
    {
    }

    #[Route('/{id}', methods: ['PATCH'])]
    public function partialUpdate(): Response
    {
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(): Response
    {
    }
}
