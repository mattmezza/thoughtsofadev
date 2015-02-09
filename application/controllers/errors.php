<?php

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
