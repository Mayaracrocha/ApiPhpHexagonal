<?php

namespace Domain\Service;

use Domain\Dto\CriaCidadaoDto;
use Domain\Entity\Cidadao;
use Domain\Exception\CidadaoJaExiste;
use Domain\Repository\CidadaoRepository;

class CriarCidadao
{
    public function __construct(private CidadaoRepository $cidadaoRepository)
    {
    }

    public function criar(CriaCidadaoDto $cidadaoDto): Cidadao
    {
        $cidadaoExistente = $this->cidadaoRepository->findByCpf($cidadaoDto->getCpf());

        if ($cidadaoExistente instanceof Cidadao) {
            throw CidadaoJaExiste::fromCpf($cidadaoDto->getCpf());
        }

        $cidadao = Cidadao::novo($cidadaoDto);

        $this->cidadaoRepository->store($cidadao);

        return $cidadao;
    }
}