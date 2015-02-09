<?php

use \Fleet\BlogManager;
use \Fleet\BlogRsser;

// route for /
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
