<?php

namespace Domain\Dto;

use Assert\Assert;
use DateTime;
use Domain\Dto\CriarContatoDto;
use Domain\Dto\CriarEnderecoDto;
use Exception;
use Infrastructure\Utils\Validacao;

class CriarCidadaoDto
{
    private function __construct(
        private string $nome,
        private string $cpf,
        private DateTime $dataNascimento,
        private CriarEnderecoDto $criarEnderecoDto,
        private CriarContatoDto $criarContatoDto
    ) {
    }

    public function getId(): string
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

    public function getEndereco(): CriarEnderecoDto
    {
        return $this->criarEnderecoDto;
    }

    public function getContato(): CriarContatoDto
    {
        return $this->criarContatoDto;
    }

    public static function fromArray(array $params): static
    {
        static::validate($params);

        return new static(
            nome: $params['nome'],
            cpf: $params['cpf'],
            dataNascimento: new DateTime($params['data_nascimento']),
            criarEnderecoDto: CriarEnderecoDto::fromArray($params),
            criarContatoDto: CriarContatoDto::fromArray($params)
        );
    }

    private static function validate(array $params): void
    {
        if (! Validacao::cpf($params['cpf'])) {
            throw new Exception('CPF invalido');
        }

        Assert::that($params['cpf'])
            ->notEmpty('Cpf não enviado')
            ->string('Cpf Invalido');

        Assert::that($params['nome'])
            ->notEmpty('Nome não enviado')
            ->string('Nome precisa ser um string');

        Assert::that($params['data_nascimento'])
            ->notEmpty('Data Nascimento não enviado')
            ->date('Y-m-d', 'Data Nascimento precisa ser do format Y-m-d');
    }
}
