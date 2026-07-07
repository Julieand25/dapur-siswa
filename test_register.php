<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
try {
    echo 'OK ' . strlen(view('auth.register')->render()) . ' bytes';
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage();
}
