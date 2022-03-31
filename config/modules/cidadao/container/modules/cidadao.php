<?php

use Domain\Repository\CidadaoRepository;
use Domain\Service\CriarCidadao;
use Infrastructure\Persist\DoctrineOrm\CidadaoFromDoctrineOrm;
use Psr\Container\ContainerInterface;

$container[CriarCidadao::class] = static function (ContainerInterface $container) {
    return new CriarCidadao(
        $container->get(CidadaoRepository::class)
    );
};

$container[CidadaoRepository::class] = static function (ContainerInterface $container) {
    return new CidadaoFromDoctrineOrm(
        $container->get('doctrine-educacao')
    );
};

