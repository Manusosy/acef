<?php

// Script to create storage symlink manually on cPanel
// Bypasses the "exec() disabled" restriction

$target = __DIR__ . '/../storage/app/public';
$link = __DIR__ . '/storage';

if (file_exists($link)) {
    echo "Symlink already exists!";
} else {
    try {
        symlink($target, $link);
        echo "Successfully created storage symlink!";
    } catch (\Throwable $e) {
        echo "Error: " . $e->getMessage();
    }
}
