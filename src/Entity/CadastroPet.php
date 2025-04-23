<?php

namespace App\Entity;

use App\Repository\CadastroPetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CadastroPetRepository::class)]
class CadastroPet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $nome = null;

    #[ORM\Column(nullable: true)]
    private ?int $idade = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $sexo = null;

    #[ORM\Column(nullable: true)]
    private ?float $peso = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $raca = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $data_cadastro = null;

    #[ORM\ManyToOne(targetEntity: "App\Entity\CadastroTutor", inversedBy: "cadastroPets")]
    #[ORM\JoinColumn(nullable: false)]
    private ?CadastroTutor $tutor = null;

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

    public function getIdade(): ?int
    {
        return $this->idade;
    }

    public function setIdade(?int $idade): static
    {
        $this->idade = $idade;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(?string $sexo): static
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getPeso(): ?float
    {
        return $this->peso;
    }

    public function setPeso(?float $peso): static
    {
        $this->peso = $peso;

        return $this;
    }

    public function getRaca(): ?string
    {
        return $this->raca;
    }

    public function setRaca(?string $raca): static
    {
        $this->raca = $raca;

        return $this;
    }

    public function getDataCadastro(): ?\DateTimeInterface
    {
        return $this->data_cadastro;
    }

    public function setDataCadastro(?\DateTimeInterface $data_cadastro): static
    {
        $this->data_cadastro = $data_cadastro;

        return $this;
    }

    public function getTutor(): ?CadastroTutor
    {
        return $this->tutor;
    }

    public function setTutor(?CadastroTutor $tutor): static
    {
        $this->tutor = $tutor;

        return $this;
    }
}
