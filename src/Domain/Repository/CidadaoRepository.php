<?php

namespace Domain\Repository;

use Domain\Dto\GetCidadaoDto;
use Domain\Entity\Cidadao;

interface CidadaoRepository
{
    public function store(Cidadao $cidadao): void;

    public function findByCpf(string $cpf): ?Cidadao;

    public function findById(int $id): ?Cidadao;

    public function getById(int $id): ?Cidadao;

    public function buscar(GetCidadaoDto $getCidadaoDto): ?Cidadao;

    public function delete(Cidadao $cidadao): void;
}
