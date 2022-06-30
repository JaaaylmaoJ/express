<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use App\Repository\CartProductRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints\NotNull;

#[ORM\Entity(repositoryClass: CartProductRepository::class)]
#[ApiResource]
class CartProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $product_id;

    #[ORM\Column(type: 'integer')]
    private $cart_id;

    #[NotNull]
    #[OneToOne(mappedBy: "cartProduct", targetEntity: Product::class)]
    public ?Product $product;

    #[NotNull]
    #[OneToOne(mappedBy: "cartProduct", targetEntity: Cart::class)]
    public ?Cart $cart;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): ?int
    {
        return $this->product_id;
    }

    public function setProductId(int $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getCartId(): ?int
    {
        return $this->cart_id;
    }

    public function setCartId(int $cart_id): self
    {
        $this->cart_id = $cart_id;

        return $this;
    }
}
