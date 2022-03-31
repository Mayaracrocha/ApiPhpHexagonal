<?php

use Application\Rest\CriaCidadaoAction;
use Slim\App;

/** @var App $app */
$container = $app->getContainer();

$app->post('/cidadao', new CriaCidadaoAction($container));
