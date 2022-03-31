<?php

namespace Infrastructure\Persist\DoctrineOrm;

use Doctrine\ORM\EntityManager;
use Domain\Entity\Cidadao;
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
            'cpf' => $cpf
        ]);
    }
}