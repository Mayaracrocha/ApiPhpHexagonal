<?php

namespace Domain\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Domain\Dto\AtualizaCidadaoDto;
use Domain\Dto\CriarCidadaoDto;

/**
 * @ORM\Entity
 * @ORM\Table(name="cidadao")
 */
class Cidadao
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /** @ORM\Column(name="nome", type="string") */
    private ?string $nome;

    /** @ORM\Column(name="cpf", type="string") */
    private ?string $cpf;

    /** @ORM\Column(name="data_nascimento", type="date") */
    private ?DateTime $dataNascimento;
    /** @ORM\OneToOne(targetEntity="Contato", mappedBy="cidadao",cascade={"persist"},orphanRemoval=true) */
    private Contato $contato;
    /** @ORM\OneToOne(targetEntity="Endereco", mappedBy="cidadao",cascade={"persist"},orphanRemoval=true) */
    private Endereco $endereco;

    private function __construct()
    {
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

    public function jsonSerialize(): array
    {
        $props = get_object_vars($this);

        $props['dataNascimento'] = $this->dataNascimento->format('Y-m-d');

        $props['contato'] = $this->contato->jsonSerialize();

        $props['endereco'] = $this->endereco->jsonSerialize();

        return $props;
    }

    public static function novo(CriarCidadaoDto $criaCidadaoDto): self
    {
        $instance = new self();

        $instance->nome           = $criaCidadaoDto->getNome();
        $instance->cpf            = $criaCidadaoDto->getCpf();
        $instance->dataNascimento = $criaCidadaoDto->getDataNascimento();

        $instance->contato = Contato::novo($criaCidadaoDto->getContato(), $instance);

        $instance->endereco = Endereco::novo($criaCidadaoDto->getEndereco(), $instance);

        return $instance;
    }

    public function atualiza(AtualizaCidadaoDto $atualizaCidadaoDto): void
    {
        $this->nome           = $atualizaCidadaoDto->getNome();
        $this->cpf            = $atualizaCidadaoDto->getCpf();
        $this->dataNascimento = $atualizaCidadaoDto->getDataNascimento();
    }
}
