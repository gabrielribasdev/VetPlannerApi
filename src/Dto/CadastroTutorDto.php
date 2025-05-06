<?php
namespace App\Dto;

use App\Entity\CadastroTutor;

class CadastroTutorDto
{
    private ?int $id;
    private ?string $nome;
    private ?string $email;
    private ?string $telefone;
    private ?string $cpf;
    private ?string $endereco;
    private array $pets;

    public function __construct(CadastroTutor $cadastroTutor)
    {
        $this->id = $cadastroTutor->getId();
        $this->nome = $cadastroTutor->getNome();
        $this->email = $cadastroTutor->getEmail();
        $this->telefone = $cadastroTutor->getTelefone();
        $this->cpf = $cadastroTutor->getCpf();
        $this->endereco = $cadastroTutor->getEndereco();

        $this->pets = [];
        foreach ($cadastroTutor->getCadastroPets() as $pet) {
            $this->pets[] = [
                'id' => $pet->getId(),
                'nome' => $pet->getNome(),
            ];
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function getPets(): array
    {
        return $this->pets;
    }
}
