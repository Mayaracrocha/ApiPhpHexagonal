<?php

namespace Domain\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Domain\Dto\CriaCidadaoDto;

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

    private function __construct()
    {
    }

    public function jsonSerialize(): array
    {
        $props = get_object_vars($this);

        $props['dataNascimento'] = $this->dataNascimento->format('Y-m-d');

        return $props;
    }

    public static function novo (CriaCidadaoDto $criaCidadaoDto)
    {
        $instance = new static;

        $instance->nome = $criaCidadaoDto->getNome();
        $instance->cpf = $criaCidadaoDto->getCpf();
        $instance->dataNascimento = $criaCidadaoDto->getDataNascimento();

        return $instance;
    }
}