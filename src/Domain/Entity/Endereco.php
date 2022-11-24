<?php

namespace Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use Domain\Dto\AtualizaEnderecoDto;
use Domain\Dto\CriarEnderecoDto;

/**
 * @ORM\Entity
 * @ORM\Table(name="endereco")
 */
class Endereco
{
    /**
     * @ORM\Id
     * @ORM\Column(name="end_cod", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;
    /** @ORM\Column(name="end_cep", type="integer") */
    private ?string $cep;
    /** @ORM\Column(name="end_logradouro", type="string") */
    private ?string $logradouro;
    /** @ORM\Column(name="end_numero", type="string") */
    private ?string $numero;
    /** @ORM\Column(name="end_complemento", type="string") */
    private ?string $complemento;
    /** @ORM\Column(name="end_bairro", type="string") */
    private ?string $bairro;
    /** @ORM\Column(name="end_cidade", type="string") */
    private ?string $cidade;
    /** @ORM\Column(name="end_uf", type="string") */
    private ?string $uf;
    /** @ORM\Column(name="end_ibge", type="string") */
    private ?string $ibge;
    /** @ORM\Column(name="end_gia", type="string") */
    private ?string $gia;
    /** @ORM\Column(name="end_ddd", type="string") */
    private ?string $ddd;
    /** @ORM\Column(name="end_siafi", type="string") */
    private ?string $siafi;
    /**
     * @ORM\OneToOne(targetEntity="Cidadao")
     * @ORM\JoinColumn(name="end_cid", referencedColumnName="id")
     */
    private Cidadao $cidadao;

    private function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
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

    public function getGia(): ?string
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

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function atualiza(AtualizaEnderecoDto $atuEnderecoDto): void
    {
        $this->cep         = $atuEnderecoDto->getCep();
        $this->logradouro  = $atuEnderecoDto->getLogradouro();
        $this->numero      = $atuEnderecoDto->getNumero() ?? null;
        $this->complemento = $atuEnderecoDto->getComplemento();
        $this->bairro      = $atuEnderecoDto->getBairro();
        $this->cidade      = $atuEnderecoDto->getCidade();
        $this->uf          = $atuEnderecoDto->getUf();
        $this->ibge        = $atuEnderecoDto->getIbge();
        $this->gia         = $atuEnderecoDto->getGia();
        $this->ddd         = $atuEnderecoDto->getDdd();
        $this->siafi       = $atuEnderecoDto->getSiafi();
    }

    public static function novo(CriarEnderecoDto $criarEnderecoDto, Cidadao $cidadao): self
    {
        $instance = new self();

        $instance->cep         = $criarEnderecoDto->getCep();
        $instance->logradouro  = $criarEnderecoDto->getLogradouro();
        $instance->numero      = $criarEnderecoDto->getNumero() ?? null;
        $instance->complemento = $criarEnderecoDto->getComplemento();
        $instance->bairro      = $criarEnderecoDto->getBairro();
        $instance->cidade      = $criarEnderecoDto->getCidade();
        $instance->uf          = $criarEnderecoDto->getUf();
        $instance->ibge        = $criarEnderecoDto->getIbge();
        $instance->gia         = $criarEnderecoDto->getGia();
        $instance->ddd         = $criarEnderecoDto->getDdd();
        $instance->siafi       = $criarEnderecoDto->getSiafi();
        $instance->cidadao     = $cidadao;

        return $instance;
    }
}
