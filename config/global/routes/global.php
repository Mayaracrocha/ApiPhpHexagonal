<?php

use Slim\Http\Request;
use Slim\Http\Response;

$modules = require __DIR__ . '/../modules.php';

$app->get('/', function (Request $request, Response $response) {
    return $response->withJson([
        'success' => true,
        'message' => 'API Educação v3'
    ]);
});

foreach ($modules as $module) {
    $app->get('/' . $module, function (Request $request, Response $response) use ($module) {
        return $response->withJson([
            'success' => true,
            'message' => 'API Educação v3',
            'documentation' => getenv('APP_URL') . '/apidoc/' . $module . '/index.html'
        ]);
    });

    require_once sprintf(__DIR__ . '/../../modules/%s/routes/versions.php', $module);
}
