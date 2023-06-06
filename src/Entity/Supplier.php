<?php

namespace App\Entity;

use App\Repository\SupplierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SupplierRepository::class)]
class Supplier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $sup_name = null;

    #[ORM\Column]
    private ?bool $importer = null;

    #[ORM\ManyToMany(targetEntity: Phone::class, mappedBy: 'suppliers')]
    private Collection $phones;

    public function __construct()
    {
        $this->phones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupName(): ?string
    {
        return $this->sup_name;
    }

    public function setSupName(string $sup_name): self
    {
        $this->sup_name = $sup_name;

        return $this;
    }

    public function isImporter(): ?bool
    {
        return $this->importer;
    }

    public function setImporter(bool $importer): self
    {
        $this->importer = $importer;

        return $this;
    }

    /**
     * @return Collection<int, Phone>
     */
    public function getPhones(): Collection
    {
        return $this->phones;
    }

    public function addPhone(Phone $phone): self
    {
        if (!$this->phones->contains($phone)) {
            $this->phones->add($phone);
            $phone->addSupplier($this);
        }

        return $this;
    }

    public function removePhone(Phone $phone): self
    {
        if ($this->phones->removeElement($phone)) {
            $phone->removeSupplier($this);
        }

        return $this;
    }
}
