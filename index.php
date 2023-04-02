<?php

include './vendor/autoload.php';
include './src/config.php';
include './src/eloquent.php';

use App\Model\Eloquent\User;
use Base\Application;

$app = new Application();
$app->run();

?>