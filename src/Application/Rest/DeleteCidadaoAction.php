<?php

namespace Application\Rest;

use Domain\Dto\DeleteCidadaoDto;
use Domain\Service\DeleteCidadao;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DeleteCidadaoAction
{
    public function __construct(private ContainerInterface $container)
    {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $dados            = $request->getParsedBody();
        $deleteCidadaoDto = DeleteCidadaoDto::fromArray($dados);

        /** @var DeleteCidadao $deleteCidadao */
        $deleteCidadao = $this->container->get(DeleteCidadao::class);
        $cidadao       = $deleteCidadao->delete($deleteCidadaoDto);

        $body = $response->getBody();
        $body->write(json_encode([
            'mensagem' => 'Cidadao excluído com sucesso',
        ], JSON_THROW_ON_ERROR));

        return $response
            ->withStatus(201)
            ->withHeader('Content-Type', 'application/json')
            ->withBody($body);
    }
}
