<?php

namespace Application\Rest;

use ArrayKeysCaseTransform\ArrayKeys;
use Domain\Dto\GetCidadaoDto;
use Domain\Repository\CidadaoRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCidadaoAction
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $dados = $request->getQueryParams();

        $getCidadaoDto = GetCidadaoDto::fromArray($dados);

        /** @var CidadaoRepository $getCidadao */
        $getCidadao = $this->container->get(CidadaoRepository::class);

        $cidadao = $getCidadao->buscar($getCidadaoDto);


        $body = $response->getBody();
        $body->write(json_encode([
            'mensagem' => 'Cidadao localizado com sucesso',
            'dados'    => ArrayKeys::toSnakeCase($cidadao->jsonSerialize()),
        ], JSON_THROW_ON_ERROR));

        return $response
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withBody($body);
    }
}
