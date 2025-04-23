<?php

namespace App\Dto;

use App\Entity\Servicos;

class ServicosDto
{
    private int $id;
    private string $nome;
    private string $duracao;
    private float $preco;
    private ?string $observacao;

    public function __construct(Servicos $servico)
    {
        $this->id = $servico->getId();
        $this->nome = $servico->getNome();
        $this->duracao = $servico->getDuracao()->format('H:i:s');
        $this->preco = (float) $servico->getPreco();
        $this->observacao = $servico->getObservacao();
    }

    public function __serialize(): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'duracao' => $this->duracao,
            'preco' => $this->preco,
            'observacao' => $this->observacao
        ];
    }
}
