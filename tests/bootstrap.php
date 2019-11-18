<?php
include __DIR__.'/../vendor/autoload.php';

// To show the UI during testing
//\Orchestra\Testbench\Dusk\Options::withUI();

// To hide the UI during testing
\Orchestra\Testbench\Dusk\Options::withoutUI();