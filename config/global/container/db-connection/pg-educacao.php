<?php

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;

$container['doctrine-educacao'] = static function () {
    $paths = [__DIR__ . '/../../../src'];
    $isDevMode = getenv('APP_ENV') !== 'prod';

    AnnotationRegistry::registerLoader('class_exists');

    $configuration = Setup::createConfiguration($isDevMode);
    $configuration->setAutoGenerateProxyClasses(true);
    $configuration->setMetadataDriverImpl(new AnnotationDriver(new AnnotationReader(), $paths));

    $connectionParams = [
        'dbname'   => getenv('DB_NAME'),
        'user'     => getenv('DB_USER'),
        'password' => getenv('DB_PASS'),
        'host'     => getenv('DB_HOST'),
        'port'     => getenv('DB_PORT'),
        'driver'   => getenv('DB_DRIVER'),
        'charset'  => 'utf8',
    ];

    $em = EntityManager::create($connectionParams, $configuration);

    // Dynamic containers included
    $modules = require __DIR__ . '/../../modules.php';

    foreach ($modules as $module) {
        require_once sprintf(__DIR__ . '/../../../modules/%s/container/db-connection/doctrine-types.php', $module);
    }

    return $em;
};
