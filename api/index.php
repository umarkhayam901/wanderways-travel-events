<?php

/**
 * WanderWays Travel Event Management Mini-Platform
 * Vercel Serverless Entry Point
 *
 * This file adapts Laravel 13 for Vercel's serverless environment by:
 * 1. Preparing required writable runtime directories in /tmp.
 * 2. Redirecting storage, view compilation, and bootstrap caches to /tmp.
 * 3. Handling fallback SQLite database portability for serverless cold-starts.
 * 4. Forwarding execution into Laravel's public/index.php.
 */

// 1. Prepare temporary writable storage directories in /tmp
$storagePath = '/tmp/storage';

$runtimeDirs = [
    $storagePath . '/framework/views',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/logs',
    '/tmp/bootstrap/cache',
];

foreach ($runtimeDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// 2. Set environment variables to point Laravel runtime paths to /tmp
putenv('LARAVEL_STORAGE_PATH=' . $storagePath);
$_ENV['LARAVEL_STORAGE_PATH'] = $storagePath;
$_SERVER['LARAVEL_STORAGE_PATH'] = $storagePath;

putenv('VIEW_COMPILED_PATH=' . $storagePath . '/framework/views');
$_ENV['VIEW_COMPILED_PATH'] = $storagePath . '/framework/views';
$_SERVER['VIEW_COMPILED_PATH'] = $storagePath . '/framework/views';

putenv('APP_CONFIG_CACHE=/tmp/bootstrap/cache/config.php');
putenv('APP_EVENTS_CACHE=/tmp/bootstrap/cache/events.php');
putenv('APP_PACKAGES_CACHE=/tmp/bootstrap/cache/packages.php');
putenv('APP_ROUTES_CACHE=/tmp/bootstrap/cache/routes.php');
putenv('APP_SERVICES_CACHE=/tmp/bootstrap/cache/services.php');

// 3. Fallback SQLite handling if running locally on Vercel without external DB
$dbConnection = getenv('DB_CONNECTION') ?: ($_ENV['DB_CONNECTION'] ?? 'sqlite');
if ($dbConnection === 'sqlite') {
    $tmpDb = '/tmp/database.sqlite';
    $sourceDb = __DIR__ . '/../database/database.sqlite';

    if (!file_exists($tmpDb) && file_exists($sourceDb)) {
        copy($sourceDb, $tmpDb);
    }

    if (file_exists($tmpDb)) {
        putenv('DB_DATABASE=' . $tmpDb);
        $_ENV['DB_DATABASE'] = $tmpDb;
        $_SERVER['DB_DATABASE'] = $tmpDb;
    }
}

// 4. Normalize server variables so Laravel generates clean routes and asset URLs
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';

// 5. Forward execution to Laravel's public entrypoint
require __DIR__ . '/../public/index.php';
