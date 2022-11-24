<?php

namespace Infrastructure\Persist\DoctrineOrm;

use Doctrine\ORM\EntityManager;
use Domain\Dto\GetCidadaoDto;
use Domain\Entity\Cidadao;
use Domain\Exception\CidadaoNaoExiste;
use Domain\Repository\CidadaoRepository;

class CidadaoFromDoctrineOrm implements CidadaoRepository
{
    public function __construct(private EntityManager $entityManager)
    {
    }

    public function store(Cidadao $cidadao): void
    {
        $this->entityManager->persist($cidadao);

        $this->entityManager->flush();
    }

    public function findByCpf(string $cpf): ?Cidadao
    {
        return $this->entityManager->getRepository(Cidadao::class)->findOneBy([
            'cpf' => $cpf,
        ]);
    }

    public function findById(int $id): ?Cidadao
    {
        return $this->entityManager->getRepository(Cidadao::class)->findOneBy([
            'id' => $id,
        ]);
    }

    public function getById(int $id): ?Cidadao
    {
        $cidadao = $this->cidadaoRepository->findById($id);
        if ($cidadao === null) {
            throw CidadaoNaoExiste::fromId($id);
        }

        return $cidadao;
    }

    public function buscar(GetCidadaoDto $getCidadaoDto): ?Cidadao
    {
        return $this->entityManager->getRepository(Cidadao::class)->findOneBy([
            'nome' => $getCidadaoDto->getNome(),
        ]);
    }

    public function delete(Cidadao $cidadao): void
    {
        $this->entityManager->remove($cidadao);

        $this->entityManager->flush();
    }
}
