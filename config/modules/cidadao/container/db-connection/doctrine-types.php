<?php

use Doctrine\DBAL\Types\Type;

// Array with all custom types
$types = array_merge(
    require __DIR__ . '/doctrine-types/cidadao.php'
);

foreach ($types as $doctrineTypeId => $classType) {
    Type::addType($doctrineTypeId, $classType);
}
