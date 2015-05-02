<?php

$layout = new \Standard\View\Viewmodel();
$layout->setScriptname('layout/standard_offline');

$viewmodel = new \Standard\View\Viewmodel();
$viewmodel->setScriptname($routeMatch);
$viewmodel->set('layout', $layout);

$resolver = new \Standard\View\TemplatemapResolver();
$resolver->setTemplatemap(include __DIR__.'/config/templateMap.php');

$viewRenderer = new \Standard\View\RendererPhp($viewmodel, $resolver);

$layout->set('view', $viewmodel);
$layout->set('content', $viewRenderer->render());

$viewRenderer->setViewmodel($layout);
return $viewRenderer->render();