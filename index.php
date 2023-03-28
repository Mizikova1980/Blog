<?php

include './vendor/autoload.php';
include './src/config.php';

use Base\Application;

$app = new Application();
$app->run();

?>