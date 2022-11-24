<?php

namespace Domain\Repository;

use Domain\Entity\Contato;

interface ContatoRepository
{
    public function store(Contato $contato): void;

    public function findById(int $id): Contato;

    public function getById(int $id): Contato;

    public function getCidadaoId(int $cidadaoId): Contato;

    public function delete(Contato $contato): void;

    public function deleteByCidadaoId(int $id): void;
}
