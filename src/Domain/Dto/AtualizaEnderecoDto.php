<?php

namespace Domain\Dto;

class AtualizaEnderecoDto
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

    public function getsiafi(): string
    {
        return $this->siafi;
    }

    public function mergeViaCep(AtualizaEnderecoDto $atuEnderecoDto)
    {
        $this->cep         = $atuEnderecoDto->getCep() ?? $this->cep;
        $this->logradouro  = $atuEnderecoDto->getLogradouro() ?? $this->logradouro;
        $this->numero      = $atuEnderecoDto->getNumero() ?? $this->numero;
        $this->complemento = $atuEnderecoDto->getComplemento() ?? $this->complemento;
        $this->bairro      = $atuEnderecoDto->getBairro() ?? $this->bairro;
        $this->cidade      = $atuEnderecoDto->getCidade() ?? $this->cidade;
        $this->uf          = $atuEnderecoDto->getUf() ?? $this->uf;
        $this->ibge        = $atuEnderecoDto->getIbge() ?? $this->ibge;
        $this->gia         = $atuEnderecoDto->getGia() ?? $this->gia;
        $this->ddd         = $atuEnderecoDto->getDdd() ?? $this->ddd;
        $this->siafi       = $atuEnderecoDto->getSiafi() ?? $this->siafi;
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
