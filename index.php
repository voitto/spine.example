<?php


define( 'DATABASE_ENGINE',    'pgsql'); // mysql | pgsql | couchdb | mongodb | sqlite
define( 'DATABASE_USER',      'brian');
define( 'DATABASE_PASSWORD',  '');
define( 'DATABASE_NAME',      'todos');
define( 'DATABASE_HOST',      ''); // 'localhost' | '' | IP | name
define( 'DATABASE_PORT',      5432); // 3306/mysql | 5432/pgsql | 443



require 'lib/Structal.php';
require 'lib/Moor.php';
require 'lib/Mullet.php';




// models and controllers go here





function index() {
  require 'lib/Mustache.php';
  $m = new Mustache;
  session_start();
  $params = array();
  if (isset($_SESSION['current_user']))
    $params['username'] = $_SESSION['current_user'];
  echo $m->render(file_get_contents('tpl/index.html'),$params);
}


if (isset($_GET['class'])) {
  $class = ucwords($_GET['class']);
  $method = strtolower($_SERVER['REQUEST_METHOD']);
  if (isset($_GET['method']))
    $method = $_GET['method'];
  if (method_exists($class,$method))
    $class::$method();
} else {
  index();
}


/*

//
// Instructions for using pretty URLs with Spine.js or Backbone.js
//


// .htaccess example:

// RewriteEngine on
// RewriteCond %{REQUEST_FILENAME} !-d
// RewriteCond %{REQUEST_FILENAME} !-f
// RewriteRule ^.*$ index.php [QSA,NS]


// include Moor, a routing library like this:

// require 'lib/Moor.php';


// and finally, set up Moor routes:

if (!in_array(strtolower($_SERVER['REQUEST_METHOD']),array('put','delete')))
  Moor::route('/@class/@method', '@class(uc)::@method(lc)');
Moor::route('/@class/:id([0-9A-Za-z_-]+)', '@class(uc)::'.strtolower($_SERVER['REQUEST_METHOD']));
Moor::route('/@class', '@class(uc)::'.strtolower($_SERVER['REQUEST_METHOD']));
Moor::route( '*', 'index' );
Moor::run();

*/