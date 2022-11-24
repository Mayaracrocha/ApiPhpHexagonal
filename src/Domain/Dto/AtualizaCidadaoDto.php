<?php

namespace Domain\Dto;

use DateTime;
use Domain\Dto\AtualizaContatoDto;
use Domain\Dto\AtualizaEnderecoDto;
use Exception;
use Infrastructure\Utils\Validacao;

class AtualizaCidadaoDto
{
    private function __construct(
        private int $id,
        private string $nome,
        private string $cpf,
        private DateTime $dataNascimento,
        private AtualizaEnderecoDto $atualizaEnderecoDto,
        private AtualizaContatoDto $atualizaContatoDto
    ) {
    }

    public function getId(): int
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

    public function getDataNascimento(): DateTime
    {
        return $this->dataNascimento;
    }

    public function getEndereco(): AtualizaEnderecoDto
    {
        return $this->atualizaEnderecoDto;
    }

    public function getContato(): AtualizaContatoDto
    {
        return $this->atualizaContatoDto;
    }

    public static function fromArray(array $params): static
    {
        static::validate($params);

        return new static(
            id: $params['id'] ?? null,
            nome: $params['nome'],
            cpf: $params['cpf'],
            dataNascimento: new DateTime($params['data_nascimento']),
            atualizaEnderecoDto: AtualizaEnderecoDto::fromArray($params),
            atualizaContatoDto: AtualizaContatoDto::fromArray($params)
        );
    }

    private static function validate(array $params): void
    {
        if (!Validacao::cpf($params['cpf'])) {
            throw new Exception('CPF invalido');
        }
        return;
    }
}
