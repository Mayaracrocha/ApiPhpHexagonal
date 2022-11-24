<?php

namespace Domain\Exception;

use DomainException;

class ContatoNaoExiste extends DomainException
{
    public static function fromId(int $contatoCod): static
    {
        return new static(sprintf('O Contato com o ID %s não existe, informe um Id valido', $contatoCod));
    }
}
