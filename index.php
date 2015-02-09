<?php
include("env.php");

function error_handler($error) {
  header("Location: /i-am-so-sorry");
}

if(getenv("env")=="production") {
  set_error_handler('error_handler');
  error_reporting(~E_ALL);
} else {
  error_reporting(~E_NOTICE);
}

require_once 'vendor/autoload.php';
use \Fleet\Utils as Utils;
use \Fleet\HandlebarsTemplate;


// needed when installed into subdirectory
// check https://github.com/chriso/klein.php/wiki/Sub-Directory-Installation
$base  = dirname($_SERVER['PHP_SELF']);
if(ltrim($base, '/')){
    $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen($base));
}

$klein = new \Klein\Klein();
$config = \Fleet\Config::getInstance();
date_default_timezone_set($config->blog->timezone);
setlocale(LC_ALL, $config->blog->locale);

$template = \Fleet\HandlebarsTemplate::getInstance($config->blog->theme);
$adminTemplate = \Fleet\HandlebarsTemplate::getAdminInstance($config->blog->admin->theme);
$klein->config = $config;
$klein->template = $template;
$klein->adminTemplate = $adminTemplate;

foreach (glob("application/controllers/*.php") as $filename)
{
    include $filename;
}


$klein->dispatch();
