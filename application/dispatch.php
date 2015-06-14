<?php
/**
 * Created by Tobias Ranft <coded@ranft.biz> 2015
 */

$layout = new \Standard\View\ViewModel();
$layout->setScriptname('layout/standard_offline');
$layout->set('runtime', isset($stopwatch) ? $stopwatch : 'unknown');

$viewmodel = new \Standard\View\ViewModel();
$viewmodel->setScriptname($routeMatch);
$viewmodel->set('layout', $layout);

$resolver = new \Standard\View\TemplatemapResolver();
$resolver->setTemplatemap(include __DIR__.'/config/templateMap.php');

$viewRenderer = new \Standard\View\RendererPhp($viewmodel, $resolver);

$layout->set('view', $viewmodel);
$layout->set('content', $viewRenderer->render());

$viewRenderer->setViewmodel($layout);
return $viewRenderer->render();