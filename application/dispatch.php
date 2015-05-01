<?php

$viewmodel = new \Standard\View\Viewmodel();
$viewmodel->setScriptname('task/fizzbuzz');

$resolver = new \Standard\View\TemplatemapResolver();
$resolver->setTemplatemap(include __DIR__.'/config/templateMap.php');

$viewRenderer = new \Standard\View\RendererPhp($viewmodel, $resolver);

return $viewRenderer->render();