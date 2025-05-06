<?php

namespace App\Entity;

use App\Repository\AgendamentosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgendamentosRepository::class)]
class Agendamentos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?CadastroPet $pet = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $data = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $horario = null;

    #[ORM\ManyToOne]
    private ?Servicos $servico = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0, nullable: true)]
    private ?string $preco = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPet(): ?CadastroPet
    {
        return $this->pet;
    }

    public function setPet(?CadastroPet $pet): static
    {
        $this->pet = $pet;

        return $this;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(?\DateTimeInterface $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function getHorario(): ?\DateTimeInterface
    {
        return $this->horario;
    }

    public function setHorario(?\DateTimeInterface $horario): static
    {
        $this->horario = $horario;

        return $this;
    }

    public function getServico(): ?servicos
    {
        return $this->servico;
    }

    public function setServico(?servicos $servico): static
    {
        $this->servico = $servico;

        return $this;
    }

    public function getPreco(): ?string
    {
        return $this->preco;
    }

    public function setPreco(?string $preco): static
    {
        $this->preco = $preco;

        return $this;
    }
}
