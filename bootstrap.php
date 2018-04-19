<?php

define("DIR", DIRECTORY_SEPARATOR);
define("ROOT", __DIR__ . DIR);
define("WS", " ");
define("TEMPLATE", "template" . DIR);
define("DB_FILE", ROOT . "database.sqlite");
define("DB_CONNECTION", array('driver' => 'pdo_sqlite', 'path' => DB_FILE));

require "vendor" . DIR . "autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

try {
    /* @var EntityManager */
    $config = Setup::createAnnotationMetadataConfiguration(array(ROOT . "Engine" . DIR . "Entities"), true);
    $entityManager = EntityManager::create(DB_CONNECTION, $config);
} catch (\Doctrine\ORM\ORMException $e) {
    echo "Can't connect to SQLite database.";
}