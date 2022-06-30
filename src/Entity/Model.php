<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Constraints\UniquePropertyConstraint;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\NotNull;


#[UniquePropertyConstraint(options: ['property' => 'name', 'entities' => [Manufacturer::class, Type::class]])]
class Model
{
    #[Id]
    #[GeneratedValue(strategy: "IDENTITY")]
    #[Column(type: 'bigint')]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[NotNull]
    #[Column(type: 'string', length: 255)]
    public string $name;

    #[ManyToOne(targetEntity: Manufacturer::class, inversedBy: 'models')]
    public ?Manufacturer $manufacturer;

    #[ManyToOne(targetEntity: Type::class, inversedBy: 'models')]
    public ?Type $type;

    #[OneToMany(mappedBy: 'model', targetEntity: Product::class)]
    public Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}