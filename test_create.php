<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$novel = App\Models\Novel::first();
if($novel) {
    App\Models\Chapter::create([
        'novel_id' => $novel->id,
        'title' => 'Test',
        'chapter_number' => 1,
        'content' => 'Test content'
    ]);
    echo 'Chapter created successfully';
} else {
    echo 'No novel found';
}
