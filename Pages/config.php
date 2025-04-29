<?php
$docRoot = $_SERVER['DOCUMENT_ROOT'];
$scriptPath = dirname($_SERVER['SCRIPT_NAME']);

$basePath = str_replace('/Pages', '', $scriptPath);
$baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . $basePath;

define('BASE_URL', $baseUrl);
define('BASE_PATH', realpath(dirname(__DIR__)));
?>