<?php

require_once 'Router.class.php';

// First, we get the URL from PHP
$url = $_SERVER["REQUEST_URI"];

// Create the routes we want to use
$routes = array(
	'#^/app/([^/]+)/?$#' => 'Handlers::appHandler',									/* /app/[command]/				*/
	'#^/(\d\d\d\d)/(\d\d)/(\d\d)/([^/]+)/?$#' => 'Handlers::blogPostHandler'		/* /2011/06/06/slug-of-post/	*/
);

// Do the routing. It'll go through the $routes array and check each regex against the string in $url, executing the first handler that matches. (Failing that, it'll execute the default handler.)
Router::route($url, $routes, 'defaultHandler');

// I've put the handlers into a class like this, but you can organize them however you like
class Handlers {
	static public function blogPostHandler($args) {
		// $args is an array of the captured groups from the regex
		$year = $args[0];
		$month = $args[1];
		$day = $args[2];
		$slug = $args[3];

		echo "Blog: $month/$day/$year, slug=$slug.";
	}

	static public function appHandler($args) {
		$slug = $args[0];

		echo "App: slug=$slug";
	}
}

// This one's to demonstrate a handler that isn't in a class
function defaultHandler() {
	echo "Default.";
}

?>
