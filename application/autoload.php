<?php
chdir(__DIR__);

$src = realpath(__DIR__.'/../src');
require_once $src . '/Standard/Autoloading/Treeloader.php';

\Standard\Autoloading\Treeloader::register(['rootPath' => $src]);
