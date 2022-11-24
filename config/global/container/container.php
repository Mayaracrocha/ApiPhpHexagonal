<?php

use Slim\Container;

$configuration = [
    'settings' => [
        'displayErrorDetails' => getenv('APP_ENV') !== 'prod',
    ],
];

/** @var Container */
$container = new Container($configuration);

require_once __DIR__ . '/global.php';
require_once __DIR__ . '/db-connection/pg-educacao.php';

// Dynamic containers included
$modules = require __DIR__ . '/../modules.php';
foreach ($modules as $module) {
    require_once sprintf(__DIR__ . '/../../modules/%s/container/container.php', $module);
}

return $container;
