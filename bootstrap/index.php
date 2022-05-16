<?php

define("PATH_ROOT", realpath(__DIR__ . '/..'));

require PATH_ROOT . '/vendor/autoload.php';

include PATH_ROOT . "/server/server.php";
include PATH_ROOT . "/helpers/role.php";
