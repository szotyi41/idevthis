<?php

use Engine\Controller;

require "bootstrap.php";

$cont = new Controller();
$cont->setEntityManager($entityManager);

if      (isset($_GET['post'])) $cont->selectPost($_GET['post']);
elseif  (isset($_GET['search'])) $cont->selectPosts($_GET['search']);
else    $cont->selectPosts(null);