<?php

namespace Application\Rest;

use ArrayKeysCaseTransform\ArrayKeys;
use Domain\Dto\AtualizaCidadaoDto;
use Domain\Service\AtualizaCidadao;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AtualizaCidadaoAction
{
    public function __construct(private ContainerInterface $container)
    {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $dados              = $request->getParsedBody();
        $atualizaCidadaoDto = AtualizaCidadaoDto::fromArray($dados);

        /** @var AtualizaCidadao $atualizaCidadao */
        $atualizaCidadao = $this->container->get(AtualizaCidadao::class);
        $cidadao         = $atualizaCidadao->atualizacao($atualizaCidadaoDto);

        $body = $response->getBody();
        $body->write(json_encode([
            'mensagem' => 'Cidadao atualizado com sucesso',
            'dados'    => ArrayKeys::toSnakeCase($cidadao->jsonSerialize()),
        ], JSON_THROW_ON_ERROR));

        return $response
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withBody($body);
    }
}
