<?php

use Application\Rest\GetCidadaoAction;
use Application\Rest\CriaCidadaoAction;
use Application\Rest\AtualizaCidadaoAction;
use Application\Rest\DeleteCidadaoAction;
use Slim\App;

/** @var App $app */
$container = $app->getContainer();

$app->get('/cidadao', new GetCidadaoAction($container));
$app->post('/cidadao', new CriaCidadaoAction($container));
$app->put('/cidadao', new AtualizaCidadaoAction($container));
$app->delete('/cidadao', new DeleteCidadaoAction($container));
