<?php
$templateMapRoot = realpath(__DIR__.'/../../view');
return [
    'layout/standard' => $templateMapRoot . '/layout/standard.phtml',
    'layout/standard_offline' => $templateMapRoot . '/layout/standard_offline.phtml',
    'task/fizzbuzz' => $templateMapRoot . '/tasks/fizzbuzz.phtml',
];