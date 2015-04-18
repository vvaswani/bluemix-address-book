<?php
// use Composer autoloader
require 'vendor/autoload.php';

// configure Slim application instance
// initialize application
$app = new \Slim\Slim(array(
  'debug' => true,
  'templates.path' => './templates'
));

// configure credentials
// ... for MongoDB
$config["db"]["uri"] = 'mongodb://db2:db2@192.168.56.101:27017/db2';

// ... for HybridAuth
$config["hybridauth"]  = array(
  "base_url" => $app->request()->getUrl() . $app->request()->getRootUri() . "/callback",
  "providers" => array (
  "Google" => array (
    "enabled" => true,
    "keys" => array (
      "id" => "YOUR_CLIENT_ID", 
      "secret" => "YOUR_CLIENT_SECRET"
    ),
    "scope" => "https://www.googleapis.com/auth/userinfo.email"
)));

// if BlueMix VCAP_SERVICES environment available
// overwrite with credentials from BlueMix
if ($services = getenv("VCAP_SERVICES")) {
  $services_json = json_decode($services, true);
  $config["db"]["uri"] = $services_json["mongolab"][0]["credentials"]["uri"];
} 
$config["db"]["name"] = substr(parse_url($config["db"]["uri"], PHP_URL_PATH), 1);

// start session
session_start();

// initialize Mongo client object
$mongo = new MongoClient($config["db"]["uri"], array("connectTimeoutMS" => 30000));
$db = $mongo->selectDb($config["db"]["name"]);

// initialize HybridAuth client
$auth = new Hybrid_Auth($config["hybridauth"]);

// index page handlers
$app->get('/', function () use ($app) {
  $app->redirect($app->urlFor('index'));
});

$app->get('/index', 'authenticate', function () use ($app, $db) {
  $collection = $db->contacts;
  $contacts = $collection->find(array('owner' => $_SESSION['uid']));
  $app->render('main.tpl.php', array('contacts' => $contacts));
})->name('index');

// add/update handlers
$app->get('/save(/:id)', 'authenticate', function ($id = null) use ($app, $db) {
  $collection = $db->contacts;
  $contact = $collection->findOne(array('_id' => new MongoId($id), 'owner' => $_SESSION['uid']));
  $app->render('form.tpl.php', array('contact' => $contact));
});

$app->post('/save', 'authenticate', function () use ($app, $db) {
  $collection = $db->contacts;  
  $name = trim(strip_tags($app->request->params('name')));
  $id = trim(strip_tags($app->request->params('id')));
  $email = trim(strip_tags($app->request->params('email')));
  $phone = trim(strip_tags($app->request->params('phone')));
  $contact = new stdClass;
  if (!empty($name)) {
    $contact->name = $name;
    $contact->owner = $_SESSION['uid'];
    $contact->phone = $phone;
    $contact->email = $email;
    if (!empty($id)) {
      $contact->_id = new MongoId($id);
    }
    $collection->save($contact);
  }
  $app->redirect($app->urlFor('index'));
});

// delete handler
$app->get('/delete/:id', 'authenticate', function ($id) use ($app, $db) {
  $collection = $db->contacts;
  $collection->remove(array('_id' => new MongoId($id), 'owner' => $_SESSION['uid']));
  $app->redirect($app->urlFor('index'));
});

// login handler
$app->get('/login', function () use ($app, $auth) {
  $google = $auth->authenticate("Google");
  $currentUser = $google->getUserProfile();
  $_SESSION['uid'] = $currentUser->email;
  $app->redirect($app->urlFor('index'));
})->name('login');

// logout handler
$app->get('/logout', 'authenticate', function () use ($app, $auth) {
  $auth->logoutAllProviders();
  session_destroy();
  $app->render('logout.tpl.php');
});

// OAuth callback handler
$app->get('/callback', function () {
  Hybrid_Endpoint::process();
});

// display legal page
$app->get('/legal', function () use ($app) {
  $app->render('legal.tpl.php');
});

// handler to delete all account data
// required by Google+ developer policies
$app->get('/delete-my-data', 'authenticate', function () use ($app, $db) {
  $collection = $db->contacts;
  $collection->remove(array('owner' => $_SESSION['uid']));
  $app->redirect($app->urlFor('index'));
});

// hook to add request URI path as template variable
$app->hook('slim.before.dispatch', function() use ($app) {
  $app->view()->appendData(array(
    'baseUri' => $app->request()->getRootUri()
  ));
}); 

$app->run();

// middleware to restrict access to authenticated users only
function authenticate () {
  $app = \Slim\Slim::getInstance();
  if (!isset($_SESSION['uid'])) {
    $app->redirect($app->urlFor('login'));
  }
}
