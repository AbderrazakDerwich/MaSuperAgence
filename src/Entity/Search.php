<?php

namespace App\Entity;

use App\Repository\SearchRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SearchRepository::class)]
class Search
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    /**
     * @Assert\Range(
     *      min = 10,
     *      max = 2000,
     *      notInRangeMessage = "Vous devez être entre {{ min }} mille dinar et {{ max }} mille dinar  ",
     * )
     */
    #[ORM\Column(type: 'integer', nullable: true)]
    private $minPrice;

     /**
     * @Assert\Range(
     *      min = 10,
     *      max = 500,
     *      notInRangeMessage = "Vous devez être entre {{ min }}m² et {{ max }}m² ",
     * )
     */
    #[ORM\Column(type: 'integer', nullable: true)]
    private $minSurface;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMinPrice(): ?int
    {
        return $this->minPrice;
    }

    public function setMinPrice(int $minPrice): self
    {
        $this->minPrice = $minPrice;

        return $this;
    }

    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    public function setMinSurface(int $minSurface): self
    {
        $this->minSurface = $minSurface;

        return $this;
    }
}
