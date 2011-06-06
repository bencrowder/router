# Router

Router is a (very) small PHP library for doing URL routing.

## Installation

1. Copy `Router.class.php` somewhere in your project directory.
2. Include it (via `require_once` or `include`).
3. Put the following into your `.htaccess` file (or rename the included `htaccess` file to `.htaccess`):

<code>
	RewriteEngine On<br/>
	RewriteCond %{REQUEST_FILENAME} !-f<br/>
	RewriteCond %{REQUEST_FILENAME} !-d<br/>
	RewriteRule . /index.php	[L]
</code>

4. Modify `index.php` as necessary.

## Usage

Usage looks like this:

	$url = $_SERVER["REQUEST_URI"];

	$routes = array(
		'#^/app/([^/]+)/?$#' => 'appHandler',
		'#^/(\d\d\d\d)/(\d\d)/(\d\d)/([^/]+)/?$#' => 'blogHandler'
	);

We've set up the array of handlers, using `#` as our regex delimiter so we don't have to escape forward slashes. The value part of each pair is the name of the handler function you want called when the associated regex matches the URL. You can use plain function names or make them static functions in a class.

	Router::route($url, $routes, 'defaultHandler');

This does the routing. You pass in the string to parse (the URL), the array of routes, and the name of the default handler.

	function appHandler($args) {
		echo $args[0];
	}

	function blogHandler($args) {
		$year = $args[0];
		$month = $args[1];
		$day = $args[2];
		$slug = $args[3];

		echo "Blog post date: $month/$day/$year<br>";
		echo "Slug: $slug";
	}

	function defaultHandler() {
		echo "Default";
	}

And here are the (very simplistic) handlers.
