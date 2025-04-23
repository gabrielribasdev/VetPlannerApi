<?php
namespace App\Dto;

use App\Entity\CadastroPet;
use DateTimeInterface;

class CadastroPetDto
{
    private ?int $id;
    private string $nome;
    private int $idade;
    private ?string $sexo;
    private ?float $peso;
    private ?string $raca;
    private ?DateTimeInterface $dataCadastro;
    private int $tutorId;

    // O construtor agora aceita um objeto CadastroPet
    public function __construct(CadastroPet $cadastroPet)
    {
        $this->id = $cadastroPet->getId();
        $this->nome = $cadastroPet->getNome();
        $this->idade = $cadastroPet->getIdade();
        $this->sexo = $cadastroPet->getSexo();
        $this->peso = $cadastroPet->getPeso();
        $this->raca = $cadastroPet->getRaca();
        $this->dataCadastro = $cadastroPet->getDataCadastro();
        $this->tutorId = $cadastroPet->getTutor()->getId();
    }

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getIdade(): int
    {
        return $this->idade;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function getPeso(): ?float
    {
        return $this->peso;
    }

    public function getRaca(): ?string
    {
        return $this->raca;
    }

    public function getDataCadastro(): ?DateTimeInterface
    {
        return $this->dataCadastro;
    }

    public function getTutorId(): int
    {
        return $this->tutorId;
    }
}
