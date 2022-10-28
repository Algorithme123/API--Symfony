<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PersonneRepository::class)]
class Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('lire:personne')]
    #[Assert\NotBlank(message : "l'Id est obligatoire")]
    #[Assert\Length(min:3)]

    private $id;



    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Length(min:3)]
    #[Groups('lire:personne')] 
    #[Assert\NotBlank(message:"le nom est obligatoire")]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message:"le prenom est obligatoire")]
    #[Assert\Length(min:3)]
    #[Groups('lire:personne')]
    private $prenom;

    
    #[ORM\Column(type: 'integer')]
    #[Groups('lire:personne')]

    private $age;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('lire:personne')]

    private $nationalite;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('lire:personne')]
    private $profession;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('lire:personne')]
    private $compagnie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getCompagnie(): ?string
    {
        return $this->compagnie;
    }

    public function setCompagnie(string $compagnie): self
    {
        $this->compagnie = $compagnie;

        return $this;
    }



    public function toArray()
    {
        return [
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'age' => $this->age,
            'nationalite' => $this->nationalite,
            'profession' => $this->profession,
            'compagnie' => $this->compagnie,

        ];
    }
}
