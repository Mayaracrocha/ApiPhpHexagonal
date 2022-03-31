<?php

namespace Application\Rest;

use ArrayKeysCaseTransform\ArrayKeys;
use Domain\Dto\CriaCidadaoDto;
use Domain\Service\CriarCidadao;
use Exception;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CriaCidadaoAction
{
    public function __construct(private ContainerInterface $container)
    {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $dados = $request->getParsedBody();
        $criaCidadaoDto = CriaCidadaoDto::fromArray($dados);

        /** @var CriarCidadao $criarCidadao */
        $criarCidadao = $this->container->get(CriarCidadao::class);
        $cidadao = $criarCidadao->criar($criaCidadaoDto);

        $body = $response->getBody();
        $body->write(json_encode([
            'mensagem' => 'Cidadao criado com sucesso',
            'dados' => ArrayKeys::toSnakeCase($cidadao->jsonSerialize())
        ], JSON_THROW_ON_ERROR));

        return $response
            ->withStatus(201)
            ->withHeader('Content-Type', 'application/json')
            ->withBody($body);
    }
}