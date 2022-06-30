<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\GeneratedValue;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Validator\Constraints\NotNull;

#[ApiResource(attributes: [
    'id',
    'name',
    'price',
])]
class Product
{
    #[Id]
    #[GeneratedValue(strategy: "IDENTITY")]
    #[Column(type: 'bigint')]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[Column(type: 'decimal', precision: 2)]
    public ?float $price;

    #[Column(type: 'string', length: 255)]
    public ?string $name;

    #[NotNull]
    #[ManyToOne(targetEntity: Model::class, inversedBy: 'products')]
    public ?Model $model;

    public function getId(): ?int
    {
        return $this->id;
    }
}