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

$cacheVars = [
    'APP_CONFIG_CACHE' => '/tmp/bootstrap/cache/config.php',
    'APP_EVENTS_CACHE' => '/tmp/bootstrap/cache/events.php',
    'APP_PACKAGES_CACHE' => '/tmp/bootstrap/cache/packages.php',
    'APP_ROUTES_CACHE' => '/tmp/bootstrap/cache/routes.php',
    'APP_SERVICES_CACHE' => '/tmp/bootstrap/cache/services.php',
];

foreach ($cacheVars as $key => $val) {
    putenv("{$key}={$val}");
    $_ENV[$key] = $val;
    $_SERVER[$key] = $val;
}

// 3. Ensure Laravel logs to stderr on Vercel so logs are visible in Vercel Runtime Logs
if (!getenv('LOG_CHANNEL') && empty($_ENV['LOG_CHANNEL'])) {
    putenv('LOG_CHANNEL=stderr');
    $_ENV['LOG_CHANNEL'] = 'stderr';
    $_SERVER['LOG_CHANNEL'] = 'stderr';
}

// 4. Default session and cache to serverless-friendly drivers if unset
// Prevents StartSession middleware from querying an unmigrated database on GET /
if (!getenv('SESSION_DRIVER') && empty($_ENV['SESSION_DRIVER'])) {
    putenv('SESSION_DRIVER=cookie');
    $_ENV['SESSION_DRIVER'] = 'cookie';
    $_SERVER['SESSION_DRIVER'] = 'cookie';
}

if (!getenv('CACHE_STORE') && empty($_ENV['CACHE_STORE'])) {
    putenv('CACHE_STORE=array');
    $_ENV['CACHE_STORE'] = 'array';
    $_SERVER['CACHE_STORE'] = 'array';
}

// 5. Fallback SQLite handling if running on Vercel without external DB
$dbConnection = getenv('DB_CONNECTION') ?: ($_ENV['DB_CONNECTION'] ?? 'sqlite');
if ($dbConnection === 'sqlite') {
    $tmpDb = '/tmp/database.sqlite';
    $sourceDb = __DIR__ . '/../database/database.sqlite';

    if (!file_exists($tmpDb)) {
        if (file_exists($sourceDb)) {
            copy($sourceDb, $tmpDb);
        } else {
            touch($tmpDb);
        }
    }

    putenv('DB_DATABASE=' . $tmpDb);
    $_ENV['DB_DATABASE'] = $tmpDb;
    $_SERVER['DB_DATABASE'] = $tmpDb;
}

// 6. Check APP_KEY and warn to stderr if missing
if (!getenv('APP_KEY') && empty($_ENV['APP_KEY'])) {
    error_log('[WanderWays Notice] APP_KEY is not set in Vercel environment variables.');
}

// 7. Normalize server variables so Laravel generates clean routes and asset URLs
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';

// 8. Forward execution to Laravel's public entrypoint with error trapping to stderr
try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    error_log('[WanderWays Fatal Error] ' . get_class($e) . ': ' . $e->getMessage() . "\n" . $e->getTraceAsString());
    http_response_code(500);
    echo "<h1>500 Internal Server Error</h1>";
    if (getenv('APP_DEBUG') === 'true' || ($_ENV['APP_DEBUG'] ?? '') === 'true') {
        echo "<pre>" . htmlspecialchars((string) $e) . "</pre>";
    }
}
