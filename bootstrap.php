<?php

require_once __DIR__ . '/vendor/autoload.php';

use Slim\App;
ini_set('intl.default_locale', 'pt_BR');
setlocale(LC_ALL, "pt_BR", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Maceio');

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$container = require __DIR__ . '/config/global/container/container.php';
$app = new App($container);

require_once __DIR__ . '/config/global/routes/global.php';
