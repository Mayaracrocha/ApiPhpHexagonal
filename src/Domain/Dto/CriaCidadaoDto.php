<?php

namespace Domain\Dto;

use Assert\Assert;
use DateTime;

class CriaCidadaoDto
{
    private function __construct(
        private string   $nome,
        private string   $cpf,
        private DateTime $dataNascimento
    )
    {
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

    public static function fromArray(array $params): static
    {
        static::validate($params);

        return new static(
            nome: $params['nome'],
            cpf: $params['cpf'],
            dataNascimento: new DateTime($params['dataNascimento'])
        );
    }

    private static function validate(array $params): void
    {
        Assert::that($params['cpf'])
            ->notEmpty('Cpf não enviado')
            ->string('Cpf precisa ser um string');

        //Assert::that(strlen($params['cpf']))
        //    ->notEq(11, 'Cpf não valido');

        Assert::that($params['nome'])
            ->notEmpty('Nome não enviado')
            ->string('Cpf precisa ser um string');

        Assert::that($params['data_nascimento'])
            ->notEmpty('Data Nascimento não enviado')
            ->date('Y-m-d', 'Data Nascimento precisa ser do format Y-m-d');
    }

}