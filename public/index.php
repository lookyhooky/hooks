<?php

require '../vendor/autoload.php';
require '../class/Message.class.php';

use \Slim\Slim as Slim;
use \League\Plates as Plates;

$app = new Slim([
    'mode' => 'development'
]);

$templates = new Plates\Engine('../templates');

$app->configureMode('development', function() use ($app) {
  $app->config([
    'log.enable' => true,
    'debug' => true
  ]);
});

$app->get('/', function() use ($templates) {
  echo $templates->render('home');
});

$app->get('/pages/:page', function($page) use ($app, $templates) {
  if (in_array($page, ['about', 'contact', 'cranes'])) {
    echo $templates->render($page);
  } else {
    $app->notFound();
  }
});

$app->get('/message/', function() use ($app, $templates) {
  $message = new jhooky\Message($app->request->get());
  echo $templates->render('message', [
    'message' => $message
  ]);
});

$app->post('/message/', function() use ($app, $templates) {

  $message = new jhooky\Message($app->request->post());

  if ($message->valid) {
    $message->email();
    echo $templates->render('/message', [
      'message' => new jhooky\Message([]),
      'notice' => ['Success!', 'Your message has been sent']
    ]);
  } else {
    $message->submitted = true;
    echo $templates->render('/message', [
      'message' => $message
    ]);
  }
});

$app->run();
?>
