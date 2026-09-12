<?php

date_default_timezone_set('America/La_Paz');

// Load environment variables from .env file
function loadEnv($filepath)
{
    if (!file_exists($filepath)) return;
    $lines = file($filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') === false || strpos($line, '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
}

loadEnv(__DIR__ . '/../../.env');

/* echo '<pre>';
var_dump($_SERVER);
echo '</pre>'; */
define('API_KEY', $_ENV['API_KEY'] ?? 'your_api_key_here');
define('DS', DIRECTORY_SEPARATOR);
//define('DS', "/");

$projectUrl = dirname($_SERVER['SCRIPT_NAME']) . '/';
//  echo "projecturl: $projectUrl";
//  echo "<br>";

$baseUrl    = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}";
//  echo "baseUrl: $baseUrl";
//  echo "<br>";

$basePath   = dirname($_SERVER['SCRIPT_FILENAME']) . DS;
//  echo "basepath: ".$basePath;
//  echo "<br>";

# ------------------------- #
// define('MODELS', $basePath."models/");
// define('VIEWS', $basePath."views/");

# ------------------------- #
define('BASE_URL', $baseUrl);

define('BASE_PATH', $basePath);

# ------------------------- #

define('APP_URL', BASE_URL . $projectUrl);
//echo APP_URL;

define('PUBLIC_URL', APP_URL . 'public/');

define('UPLOADS_URL', APP_URL . 'uploads/');
//echo UPLOADS_URL;

define('VENDOR_URL', PUBLIC_URL . 'vendor/');

define('PAGES_URL', APP_URL . 'app/views/pages/');

# ------------------------- #

define('APP_PATH', BASE_PATH . 'app' . DS);

define('CORE_PATH', APP_PATH  . 'core' . DS);

define('MODELS_PATH', APP_PATH  . 'models' . DS);

define('CONTROLLERS_PATH', APP_PATH  . 'controllers' . DS);

define('VIEWS_PATH', APP_PATH . 'views' . DS);

define('LAYOUTS_PATH', VIEWS_PATH . 'layouts' . DS);

define('PAGES_PATH', VIEWS_PATH . 'pages' . DS);

define('MODULES_PATH', VIEWS_PATH . 'modules' . DS);

# ------------------------- #

// echo '<pre>';
// var_dump(APP_URL);
// echo '</pre>';

// echo '<pre>';
// var_dump(APP_PATH);
// echo '</pre>';

// echo "<p>CONFIG OK!</p>";