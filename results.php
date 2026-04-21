<?php

$boot = new Results\Providers\ResultsServiceProvider;
$boot->register();

add_action('init', [$boot, 'boot']);
