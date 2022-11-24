<?php

namespace Domain\Exception;

use DomainException;

class CidadaoJaExiste extends DomainException
{
    public static function fromCpf(string $cpf): static
    {
        return new static(sprintf('O cidadão com o CPF %s já existe', $cpf));
    }
}
