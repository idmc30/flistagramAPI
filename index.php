<?php

/*
|---------------------------------------------------------------------------------------------------
| Initialize App
|---------------------------------------------------------------------------------------------------
*/

date_default_timezone_set("America/Lima");

require_once dirname(__FILE__) . '/constant.php';

require_once dirname(__FILE__) . '/vendor/maxlopez/slimer-core/src/Slimer/Core/autoload.php';

$app->run();
