<?php

use Engine\Controller;

require "bootstrap.php";

$cont = new Controller();
$cont->setEntityManager($entityManager);
$cont->selectPost(2);
