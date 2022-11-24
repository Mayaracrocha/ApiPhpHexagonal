<?php

namespace Domain\Service;

use Domain\Dto\CriarCidadaoDto;
use Domain\Dto\CriarEnderecoDto;
use Domain\Entity\Cidadao;
use Domain\Exception\CidadaoJaExiste;
use Domain\Repository\CidadaoRepository;
use Infrastructure\Http\ConsultaCep;

class CriarCidadao
{
    public function __construct(
        private CidadaoRepository $cidadaoRepository,
        private ConsultaCep $consultaCep
    ) {
    }

    public function criar(CriarCidadaoDto $cidadaoDto): Cidadao
    {
        $cidadaoExistente = $this->cidadaoRepository->findByCpf($cidadaoDto->getCpf());
        if ($cidadaoExistente instanceof Cidadao) {
            throw CidadaoJaExiste::fromCpf($cidadaoDto->getCpf());
        }
        $cidadao = Cidadao::novo($cidadaoDto);

        $enderecoDto = $cidadaoDto->getEndereco();

        $consultaCep = $this->consultaCep->ConsultaCep($enderecoDto->getCep());
        if ($consultaCep) {
            $newEnderecoDto = CriarEnderecoDto::fromViaCep($consultaCep);
            $enderecoDto->mergeViaCep($newEnderecoDto);
        }
        $cidadao = Cidadao::novo($cidadaoDto);
        $this->cidadaoRepository->store($cidadao);
        $cpf = $this->cidadaoRepository->findByCpf($cidadaoDto->getCpf());
        return $cidadao;
    }
}
