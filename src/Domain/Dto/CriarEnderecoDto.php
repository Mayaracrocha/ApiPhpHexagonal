<?php

namespace Domain\Dto;

class CriarEnderecoDto
{
    private string $cep;
    private string $logradouro;
    private ?string $numero = null;
    private string $complemento;
    private string $bairro;
    private string $cidade;
    private string $uf;
    private string $ibge;
    private string $gia;
    private string $ddd;
    private string $siafi;

    private function __construct()
    {
    }

    public function getCep(): string
    {
        return $this->cep;
    }

    public function getLogradouro(): string
    {
        return $this->logradouro;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function getComplemento(): string
    {
        return $this->complemento;
    }

    public function getBairro(): string
    {
        return $this->bairro;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function getUf(): string
    {
        return $this->uf;
    }

    public function getIbge(): string
    {
        return $this->ibge;
    }

    public function getGia(): string
    {
        return $this->gia;
    }

    public function getDdd(): string
    {
        return $this->ddd;
    }

    public function getSiafi(): string
    {
        return $this->siafi;
    }

    public function mergeViaCep(CriarEnderecoDto $criarEnderecoDto)
    {
        $this->cep         = $criarEnderecoDto->getCep() ?? $this->cep;
        $this->logradouro  = $criarEnderecoDto->getLogradouro() ?? $this->logradouro;
        $this->numero      = $criarEnderecoDto->getNumero() ?? $this->numero;
        $this->complemento = $criarEnderecoDto->getComplemento() ?? $this->complemento;
        $this->bairro      = $criarEnderecoDto->getBairro() ?? $this->bairro;
        $this->cidade      = $criarEnderecoDto->getCidade() ?? $this->cidade;
        $this->uf          = $criarEnderecoDto->getUf() ?? $this->uf;
        $this->ibge        = $criarEnderecoDto->getIbge() ?? $this->ibge;
        $this->gia         = $criarEnderecoDto->getGia() ?? $this->gia;
        $this->ddd         = $criarEnderecoDto->getDdd() ?? $this->ddd;
        $this->siafi       = $criarEnderecoDto->getSiafi() ?? $this->siafi;
    }

    public static function fromViaCep(mixed $json): static
    {
        $instance = new static();

        $instance->cep         = $json->cep;
        $instance->logradouro  = $json->logradouro;
        $instance->complemento = $json->complemento;
        $instance->bairro      = $json->bairro;
        $instance->cidade      = $json->localidade;
        $instance->uf          = $json->uf;
        $instance->ibge        = $json->ibge;
        $instance->gia         = $json->gia;
        $instance->ddd         = $json->ddd;
        $instance->siafi       = $json->siafi;
        return $instance;
    }

    public static function fromArray(array $params): static
    {
        $instance              = new static();
        $instance->cep         = $params['end_cep'];
        $instance->logradouro  = $params['end_logradouro'];
        $instance->numero      = $params['end_numero'];
        $instance->complemento = $params['end_complemento'];
        $instance->bairro      = $params['end_bairro'];
        $instance->cidade      = $params['end_cidade'];
        $instance->uf          = $params['end_uf'];
        $instance->ibge        = $params['end_ibge'];
        $instance->gia         = $params['end_gia'];
        $instance->ddd         = $params['end_ddd'];
        $instance->siafi       = $params['end_siafi'];

        return $instance;
    }
}
