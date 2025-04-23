<?php

namespace App\Entity;

use App\Repository\CadastroTutorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CadastroTutorRepository::class)]
class CadastroTutor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $nome = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $telefone = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $cpf = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $endereco = null;

    /**
     * @var Collection<int, CadastroPet>
     */
    #[ORM\OneToMany(targetEntity: CadastroPet::class, mappedBy: 'tutor')]
    private Collection $cadastroPets;

    public function __construct()
    {
        $this->cadastroPets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): static
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(?string $telefone): static
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(?string $cpf): static
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(?string $endereco): static
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * @return Collection<int, CadastroPet>
     */
    public function getCadastroPets(): Collection
    {
        return $this->cadastroPets;
    }

    public function addPet(CadastroPet $pet): static
    {
        if (!$this->cadastroPets->contains($pet)) {
            $this->cadastroPets->add($pet);
            $pet->setTutor($this);
        }

        return $this;
    }

    public function removePet(CadastroPet $pet): static
    {
        if ($this->cadastroPets->removeElement($pet)) {
            // set the owning side to null (unless already changed)
            if ($pet->getTutor() === $this) {
                $pet->setTutor(null);
            }
        }

        return $this;
    }
}
