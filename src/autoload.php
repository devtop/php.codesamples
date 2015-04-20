<?php
chdir(__DIR__);
require_once __DIR__.'/Standard/Autoloading/Treeloader.php';

\Standard\Autoloading\Treeloader::register(['rootPath' => __DIR__]);
