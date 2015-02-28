<?php
putenv("env=development");
// putenv("env=production");

function error_handler($error) {
  header("Location: /i-am-so-sorry");
}

if(getenv("env")=="production") {
  set_error_handler('error_handler');
  error_reporting(~E_ALL);
} else {
  error_reporting(~E_NOTICE);
}

$config = json_decode(file_get_contents("config.json"))->{getenv("env")};

require_once 'vendor/autoload.php';
use \Fleet\Utils as Utils;
use \Fleet\HandlebarsTemplate;
use \Fleet\BlogManager;
use \Fleet\BlogRsser;

// needed when installed into subdirectory
// check https://github.com/chriso/klein.php/wiki/Sub-Directory-Installation
$base  = dirname($_SERVER['PHP_SELF']);
if(ltrim($base, '/')){
    $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen($base));
}

$klein = new \Klein\Klein();
date_default_timezone_set($config->blog->timezone);
setlocale(LC_ALL, $config->blog->locale);
$template = \Fleet\HandlebarsTemplate::getInstance($config->blog->theme);
$klein->config = $config;
$klein->template = $template;
$klein->adminTemplate = $adminTemplate;

// routes
$klein->respond('GET', '/', function ($request, $response, $service, $app) use ($klein) {
  $postDir = $klein->config->blog->posts->dir;
  $perPage = $klein->config->blog->posts->perpage;
  $url = $klein->config->blog->url;
  $cache = $klein->config->blog->cache;
  $blog = new BlogManager($postDir, $perPage, $url, $cache);
  $posts = $blog->get_posts(1);
  if(empty($posts)){
    $klein->abort(404);
  }
  echo $klein->template->render(
    'main',
    array(
        'blog' => $klein->config->blog,
        'posts' => $posts,
        'page' => 1,
        'has_pagination' => $blog->has_pagination(1)
    )
  );
});
$klein->respond('GET', '/[i:page]', function ($request, $response, $service, $app) use ($klein) {
  $page = $request->page;
  $page = $page ? (int)$page : 1;
  $postDir = $klein->config->blog->posts->dir;
  $perPage = $klein->config->blog->posts->perpage;
  $url = $klein->config->blog->url;
  $cache = $klein->config->blog->cache;
  $blog = new BlogManager($postDir, $perPage, $url, $cache);
  $posts = $blog->get_posts($page);
  if(empty($posts) || $page < 1){
    $klein->abort(404);
  }
  echo $klein->template->render(
    'main',
    array(
        'blog' => $klein->config->blog,
        'posts' => $posts,
        'page' => $page,
        'has_pagination' => $blog->has_pagination($page)
    )
  );
});


// The post page
$klein->respond('GET', '/[:year]/[:month]/[:name]', function ($request, $response, $service, $app) use ($klein) {
  $postDir = $klein->config->blog->posts->dir;
  $perPage = $klein->config->blog->posts->perpage;
  $url = $klein->config->blog->url;
  $cache = $klein->config->blog->cache;
  $blog = new BlogManager($postDir, $perPage, $url, $cache);
  $post = $blog->find_post($request->year, $request->month, $request->name);
  if(!$post){
    $klein->abort(404);
  }
  echo $klein->template->render(
    'post',
    array(
        'blog' => $klein->config->blog,
        'title' => $post->title,
        'post' => $post
    )
  );
});
// The JSON API
$klein->respond('GET', '/api/json', function ($request, $response, $service, $app) use ($klein) {
  header('Content-type: application/json');
  $postDir = $klein->config->blog->posts->dir;
  $perPage = $klein->config->blog->posts->perpage;
  $url = $klein->config->blog->url;
  $cache = $klein->config->blog->cache;
  $blog = new BlogManager($postDir, $perPage, $url, $cache);
  // Print the 10 latest posts as JSON
  echo json_encode($blog->get_posts(1, 10));
});
// Show the RSS feed
$klein->respond('GET', '/rss', function ($request, $response, $service, $app) use ($klein) {
  header('Content-Type: application/rss+xml');
  $postDir = $klein->config->blog->posts->dir;
  $perPage = $klein->config->blog->posts->perpage;
  $url = $klein->config->blog->url;
  $cache = $klein->config->blog->cache;
  $title = $klein->config->blog->title;
  $description = $klein->config->blog->description;
  $blog = new BlogManager($postDir, $perPage, $url, $cache);
  $rss = new BlogRsser($title, $description, $url);
  // Show an RSS feed with the 30 latest posts
  echo $rss->generate_rss($blog->get_posts(1, 30));
});


// errors
// Generic error
$klein->respond('GET', '/i-am-so-sorry', function ($request, $response, $service, $app) use ($klein) {
  $klein->abort(500);
});

// Using range behaviors via if/else
$klein->onHttpError(function ($code, $router) use ($klein) {
    if ($code >= 400 && $code < 500) {
      echo $klein->template->render(
        '404',
        array(
            'blog' => $klein->config->blog
        )
      );
    } elseif ($code >= 500 && $code <= 599) {
      echo $klein->template->render(
        '500',
        array(
            'blog' => $klein->config->blog
        )
      );
    }
});

$klein->dispatch();
