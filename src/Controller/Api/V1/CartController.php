<?php

namespace Symfony\Component\HttpKernel\Controller\Api\V1;

use App\Entity\CartProduct;
use App\Repository\CartRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\CartProductRepositoryInterface;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class CartController extends AbstractController
{
    public function __construct(
        private CartRepositoryInterface $cartRepository,
        private CartProductRepositoryInterface $cartProductRepository,
    ) {
    }

    #[Route('/api/v1/cart/{id}')]
    public function cart(Request $request): JsonResponse
    {
        $cart = $this->cartRepository->getOrCreate();

        return $this->json([
            'cost'          => array_sum(array_column($cart->products->toArray(), 'price')),
            'products'      => $cart->products,
            'productsCount' => $cart->products->count(),
        ]);
    }

    #[Route('/api/v1/cart/{id}/attach/{productId}')]
    public function attachProduct(Request $request): JsonResponse
    {
        $id   = $request->get('productId');
        $cart = $this->cartRepository->getOrCreate();

        $link = new CartProduct();
        $link->setProductId($id);
        $link->setCartId($cart->getId());

        try {
            $this->cartProductRepository->add($link);
        } catch(Exception $e) {
            return $this->json(false);
        }

        return $this->json(true);
    }

    #[Route('/api/v1/cart/{id}/detach/{productId}')]
    public function detachProduct(Request $request): JsonResponse
    {
        $productId = $request->get('productId');
        $cart      = $this->cartRepository->getOrCreate();

        if(!$cart->products->containsKey($productId)) {
            return $this->json(false);
        }

        $link = $this->cartProductRepository->findOneBy(['product_id' => $productId, 'cart_id' => $cart->getId()]);

        try {
            $this->cartProductRepository->remove($link);
        } catch(Exception $e) {
            return $this->json(false);
        }

        return $this->json(true);
    }
}