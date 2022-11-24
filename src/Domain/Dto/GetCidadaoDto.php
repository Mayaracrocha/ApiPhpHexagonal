<?php

namespace Domain\Dto;

class GetCidadaoDto
{
    private function __construct(
        private string $nome
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public static function fromArray(array $params): static
    {
        return new static(
            nome: $params['nome']
        );
    }
}
