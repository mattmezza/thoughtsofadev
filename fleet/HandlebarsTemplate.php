<?php

namespace Fleet;

use Handlebars\Handlebars;
use Handlebars\Loader\FilesystemLoader;

class HandlebarsTemplate {

	public static function getInstance($theme = "default") {
		$dir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . $theme . DIRECTORY_SEPARATOR . "views";
		if(HandlebarsTemplate::$HANDLEBARS == null) {

			$loader = new FilesystemLoader($dir, [
					"extension" => "html"
			]);

			# Set the partials files
			$partialsDir = $dir . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR;
			$partialsLoader = new FilesystemLoader($partialsDir, [
					"extension" => "html"
			]);

			HandlebarsTemplate::$HANDLEBARS = new Handlebars([
					"loader" => $loader,
					"partials_loader" => $partialsLoader
			]);
		}
		HandlebarsTemplate::$HANDLEBARS->addHelper("striptags",
														function($template, $context, $args, $source){
																return strip_tags($context->get($args));
		});
		HandlebarsTemplate::$HANDLEBARS->addHelper("excerpt",
														function($template, $context, $args, $source){
															preg_match("/(.*?)\s+(.*?)\s+(?:(?:\"|\')(.*?)(?:\"|\'))/", trim($args), $m);
															$keyname = $m[1];
															$limit = $m[2];
															$ellipsis = $m[3];
															$varContent = strip_tags($context->get($keyname));
															$words = str_word_count($varContent, 2);
															$value = "";
															if(count($words) > $limit) {
																$permitted = array_slice($words, 0, $limit, true);
																end($permitted);
																$lastWordPosition = key($permitted);
																$lastWord = $permitted[$lastWordPosition];
																$lastWordLength = strlen($lastWord);
																$realLimit = $lastWordPosition+$lastWordLength;
																$value = substr($varContent, 0, $realLimit);
															} else {
																$value .= $varContent;
															}
															if ($ellipsis) {
																	$value .= $ellipsis;
															}
															return $value;
		});

		HandlebarsTemplate::$HANDLEBARS->addHelper("format_date_with_locale",
														function($template, $context, $args, $source){
															preg_match("/(.*?)\s+(?:(?:\"|\')(.*?)(?:\"|\'))/", $args, $m);
															$keyname = $m[1];
															$format = $m[2];

															$date = $context->get($keyname);
															$localized_date = "bad format";
															if ($format && is_numeric($date)) {
																$localized_date = strftime($format, $date);
															}
															return $localized_date;
		});

		return HandlebarsTemplate::$HANDLEBARS;
	}

	public static function getAdminInstance($theme = "default") {
		$dir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . $theme . DIRECTORY_SEPARATOR . "views";
		if(HandlebarsTemplate::$HANDLEBARS_ADMIN == null) {

			$loader = new FilesystemLoader($dir, [
					"extension" => "html"
			]);

			# Set the partials files
			$partialsDir = $dir . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR;
			$partialsLoader = new FilesystemLoader($partialsDir, [
					"extension" => "html"
			]);

			HandlebarsTemplate::$HANDLEBARS_ADMIN = new Handlebars([
					"loader" => $loader,
					"partials_loader" => $partialsLoader
			]);
		}
		return HandlebarsTemplate::$HANDLEBARS_ADMIN;
	}

	private static $HANDLEBARS;
	private static $HANDLEBARS_ADMIN;
}
