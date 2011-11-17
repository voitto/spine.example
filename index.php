<?php


$config = array(
  '',       // host name ('localhost' | '' | IP | name)
  'brian',  // db user name
  '',       // db user password
  'docs',   // db name
  5432,     // port number (3306/mysql | 5432/pgsql | 443/ssl)
  'pgsql'   // db type (mysql | pgsql | couchdb | mongodb | sqlite | remote)
);



require 'lib/Moor.php';
require 'lib/Structal.php';
require 'lib/Mullet.php';




// Add your models and controllers





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

(optional) Routes (requires Moor.php)

if (!in_array(strtolower($_SERVER['REQUEST_METHOD']),array('put','delete')))
  Moor::route('/@class/@method', '@class(uc)::@method(lc)');
Moor::route('/@class/:id([0-9A-Za-z_-]+)', '@class(uc)::'.strtolower($_SERVER['REQUEST_METHOD']));
Moor::route('/@class', '@class(uc)::'.strtolower($_SERVER['REQUEST_METHOD']));
Moor::route( '*', 'index' );
Moor::run();

*/





