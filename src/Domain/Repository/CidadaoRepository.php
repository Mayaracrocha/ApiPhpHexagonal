<?php

namespace Domain\Repository;

use Domain\Entity\Cidadao;

interface CidadaoRepository
{
    public function store(Cidadao $cidadao): void;

    public function findByCpf(string $cpf): ?Cidadao;
}