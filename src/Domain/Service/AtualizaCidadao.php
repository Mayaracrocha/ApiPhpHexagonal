<?php

namespace Domain\Service;

use Domain\Dto\AtualizaCidadaoDto;
use Domain\Dto\AtualizaEnderecoDto;
use Domain\Entity\Cidadao;
use Domain\Exception\CidadaoJaExiste;
use Domain\Repository\CidadaoRepository;
use Infrastructure\Http\ConsultaCep;

class AtualizaCidadao
{
    public function __construct(
        private CidadaoRepository $cidadaoRepository,
        private ConsultaCep $consultaCep
    ) {
    }

    public function atualizacao(AtualizaCidadaoDto $atualizaCidadaoDto): Cidadao
    {
        $cidadao = $this->cidadaoRepository->findById($atualizaCidadaoDto->getId());

        $cidadaoExistente = $this->cidadaoRepository->findByCpf($atualizaCidadaoDto->getCpf());

        if (
            $cidadaoExistente !== null
            && $cidadaoExistente->getId() !== $atualizaCidadaoDto->getId()
            && $cidadaoExistente instanceof Cidadao
        ) {
            throw CidadaoJaExiste::fromCpf($atualizaCidadaoDto->getCpf());
        }

        $atualizaEnderecoDto = $atualizaCidadaoDto->getEndereco();

        $consultaCep = $this->consultaCep->ConsultaCep($atualizaEnderecoDto->getCep());
        if ($consultaCep) {
            $newEnderecoDto = AtualizaEnderecoDto::fromViaCep($consultaCep);
            $atualizaEnderecoDto->mergeViaCep($newEnderecoDto);
        }

        $cidadao->atualiza($atualizaCidadaoDto);
        $this->cidadaoRepository->store($cidadao);
        return $cidadao;
    }
}
