<?php

define("DIR", DIRECTORY_SEPARATOR);
define("ROOT", __DIR__ . DIR);
define("TEMPLATE", "template" . DIR);
define("DB_FILE", ROOT . "database.sqlite");
define("DB_CONNECTION", array('driver' => 'pdo_sqlite', 'path' => DB_FILE));

require "vendor" . DIR . "autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$config = Setup::createAnnotationMetadataConfiguration(array(ROOT . "engine" . DIR . "entities"), true);
$entityManager = EntityManager::create(DB_CONNECTION, $config);