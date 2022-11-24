<?php

namespace Domain\Exception;

use DomainException;

class CidadaoNaoExiste extends DomainException
{
    public static function fromId(int $id): static
    {
        return new static(sprintf('O cidadão com o ID %s não existe, informe um Id valido', $id));
    }
}
