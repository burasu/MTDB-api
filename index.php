<?php

require 'vendor/autoload.php';

$app = new \Slim\Slim();

define("SPECIALCONSTANT", true);
require 'app/libs/connect.php';
require 'app/routes/api.php';

$app->run();
