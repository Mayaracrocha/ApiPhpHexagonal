<?php

namespace Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use Domain\Dto\AtualizaContatoDto;
use Domain\Dto\CriarContatoDto;

/**
 * @ORM\Entity
 * @ORM\Table(name="contato")
 */
class Contato
{
    /**
     * @ORM\Id
     * @ORM\Column(name="contato_cod", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /** @ORM\Column(name="email", type="string") */
    private ?string $email;
    /** @ORM\Column(name="celular", type="string") */
    private ?string $celular;
    /**
     * @ORM\OneToOne(targetEntity="Cidadao")
     * @ORM\JoinColumn(name="contato_cid", referencedColumnName="id")
     */
    private Cidadao $cidadao;

    private function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCelular(): string
    {
        return $this->celular;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function atualiza(AtualizaContatoDto $atualizaContatoDto): void
    {
        $this->email   = $atualizaContatoDto->getEmail();
        $this->celular = $atualizaContatoDto->getCelular();
    }

    public static function novo(CriarContatoDto $criarContatoDto, Cidadao $cidadao): self
    {
        $instance          = new self();
        $instance->email   = $criarContatoDto->getEmail();
        $instance->celular = $criarContatoDto->getCelular();
        $instance->cidadao = $cidadao;

        return $instance;
    }
}
