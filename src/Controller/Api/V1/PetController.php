<?php

declare(strict_types=1);

namespace App\Controller\Api\V1;

use App\Model\JsonApi\Body;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use function var_dump;

final class PetController extends AbstractController
{
    #[Route('/api/pet', methods: ['POST'])]
    public function create(Request $request, ValidatorInterface $validator): Response
    {
        /** @var Body $body */
        $body = $this->container
            ->get('serializer')
            ->deserialize(
                $request->getContent(),
                Body::class,
                'json',
            )
        ;

        $result = $validator->validate($body, new Valid());
        if ($result->count() > 0) {
            // TODO: Symfony specific serialisation?
            return $this->json(
                [
                    'errors' => [$result],
                ],
            );
        }

        $body->validate();

        $this->printId($body->data->getId());

        return $this->json($body);
    }

    private function printId(string $id): void
    {
        var_dump($id);
    }
}
