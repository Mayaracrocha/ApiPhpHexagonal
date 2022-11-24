<?php

namespace Domain\Repository;

use Domain\Entity\Endereco;

interface EnderecoRepository
{
    public function store(Endereco $endereco): void;

    public function findById(int $id): Endereco;

    public function getById(int $id): Endereco;

    public function getCidadaoId(int $cidadaoId): Endereco;

    public function delete(Endereco $endereco): void;

    public function deleteByCidadaoId(int $id): void;
}
