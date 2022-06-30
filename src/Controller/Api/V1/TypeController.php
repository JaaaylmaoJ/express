<?php

namespace Symfony\Component\HttpKernel\Controller\Api\V1;

use App\Repository\TypeRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class TypeController extends AbstractController
{
    public function __construct(private TypeRepositoryInterface $typeRepository)
    {
    }

    #[Route('/api/v1/type/{id}/products')]
    public function products(Request $request): JsonResponse
    {
        $typeId = $request->request->get('id');
        $type   = $this->typeRepository->find($typeId);

        return $this->json($type?->products->toArray());
    }
}