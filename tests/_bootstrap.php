<?php
// This is global bootstrap for autoloading
//require_once('vendor/autoload.php');


$kernel = \AspectMock\Kernel::getInstance();
$kernel->init([
    'debug' => true,
    'includePaths' => [__DIR__.'/../src']
]);