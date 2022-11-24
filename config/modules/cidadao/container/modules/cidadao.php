<?php

use Domain\Repository\CidadaoRepository;
use Domain\Repository\ContatoRepository;
use Domain\Repository\EnderecoRepository;
use Domain\Service\CriarCidadao;
use Domain\Service\AtualizaCidadao;
use Domain\Service\DeleteCidadao;
use Infrastructure\Http\ConsultaCep;
use Infrastructure\Persist\DoctrineOrm\CidadaoFromDoctrineOrm;
use Psr\Container\ContainerInterface;


$container[AtualizaCidadao::class] = static function (ContainerInterface $container) {
    return new AtualizaCidadao(
        $container->get(CidadaoRepository::class),

        $container->get(ConsultaCep::class)
    );
};

$container[CidadaoRepository::class] = static function (ContainerInterface $container) {
    return new CidadaoFromDoctrineOrm(
        $container->get('doctrine-educacao')
    );
};


$container[ConsultaCep::class] = static function () {
    return new ConsultaCep();
};


$container[CriarCidadao::class] = static function (ContainerInterface $container) {
    return new CriarCidadao(
        $container->get(CidadaoRepository::class),
        $container->get(ConsultaCep::class)
    );
};

$container[DeleteCidadao::class] = static function (ContainerInterface $container) {
    return new DeleteCidadao(
        $container->get(CidadaoRepository::class),
        $container->get(EnderecoRepository::class),
        $container->get(ContatoRepository::class)
    );
};
