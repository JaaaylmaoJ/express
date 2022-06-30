<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\NotNull;

#[Entity]
#[ApiResource]
class Manufacturer
{
    #[Id]
    #[GeneratedValue(strategy: "IDENTITY")]
    #[Column(type: 'bigint')]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[NotNull]
    #[OneToMany(mappedBy: "type", targetEntity: Type::class)]
    public Collection $models;

    public function __construct(
        #[NotNull]
        #[Column(type: 'string', length: 255, unique: true)]
        public ?string $name,
    ) {
        $this->models = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

}