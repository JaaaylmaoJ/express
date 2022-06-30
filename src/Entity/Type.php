<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\NotNull;


#[Entity]
#[ApiResource]
class Type
{
    #[Id]
    #[GeneratedValue(strategy: "IDENTITY")]
    #[Column(type: 'bigint')]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[OneToMany(mappedBy: "type", targetEntity: Type::class)]
    public Collection $models;

    //somehow
    #[OneToMany(mappedBy: "type", targetEntity: Product::class)]
    public Collection $products;

    public function __construct(
        #[Column(type: 'string', length: 255, unique: true)]
        public ?string $name = null,
    ) {
        $this->models   = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}