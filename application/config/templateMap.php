<?php
/**
 * Created by Tobias Ranft <coded@ranft.biz> 2015
 */

$templateMapRoot = realpath(__DIR__.'/../../view');
return [
    'layout/standard'         => $templateMapRoot . '/layout/standard.phtml',
    'layout/standard_offline' => $templateMapRoot . '/layout/standard_offline.phtml',
    'task/fizzbuzz'  => $templateMapRoot . '/tasks/fizzbuzz.phtml',
    'task/coffeebar' => $templateMapRoot . '/tasks/coffeebar.phtml',
    'index' => $templateMapRoot . '/overview.phtml',
];