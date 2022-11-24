<?php

namespace Domain\Service;

use Domain\Dto\DeleteCidadaoDto;
use Domain\Repository\CidadaoRepository;

class DeleteCidadao
{
    public function __construct(
        private CidadaoRepository $cidadaoRepository
    ) {
    }

    public function delete(DeleteCidadaoDto $deleteCidadaoDto)
    {
        $cidadao = $this->cidadaoRepository->findById($deleteCidadaoDto->getId());

        $this->cidadaoRepository->delete($cidadao);
    }
}
