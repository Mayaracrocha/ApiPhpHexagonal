<?php

use Core\Application\ApiTest\EmptyResponse;
use Core\Application\ApiTest\ForceParamsRequest;
use Core\Application\Middleware\DbSelector;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

require __DIR__ . '/bootstrap.php';

/** @var ContainerInterface $container */
$container = $app->getContainer();

/* Força seleção de municipio */
$params = [ 'tenant' => 'sbo' ];
$request = new ForceParamsRequest($params);
$response = new EmptyResponse();
/** @var DbSelector $dbSelector */
$dbSelector = $container->get(DbSelector::class);
$dbSelector($request, $response, fn () => $response);

/** @var EntityManager $em */
$em = $container->get('doctrine-educacao');
$connection = $em->getConnection()->getWrappedConnection();

/* Usado para as triggers de auditoria funcionar */
$connection->exec('SET gpdsys.username=1;');
$connection->exec('SET gpdsys.connection_id=1;');

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds',
    ],
    'environments' => [
        'default_database' => 'development',
        'development' => [
            'name' => 'db-api-educacao',
            'connection' => $connection,
        ]
    ],
];
