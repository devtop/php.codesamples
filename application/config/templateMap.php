<?php
$templateMapRoot = realpath(__DIR__.'/../../view');
return [
    'layout/standard' => $templateMapRoot . '/layout/standard.phtml',
    'task/fizzbuzz' => $templateMapRoot . '/tasks/fizzbuzz.phtml',
];