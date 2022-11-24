<?php

namespace Domain\Exception;

use DomainException;

class EnderecoNaoExiste extends DomainException
{
    public static function fromId(int $id): static
    {
        return new static(sprintf('O Endereco com o ID %s não existe, informe um Id valido', $id));
    }
}
