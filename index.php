<?php
declare(strict_types=1);
ini_set('session.gc_maxlifetime', '86400');
ini_set('session.cookie_lifetime', '0');
session_save_path($_SERVER['DOCUMENT_ROOT']."/sess_save/");
//
//file_put_contents($_SERVER['DOCUMENT_ROOT'].'/update.txt', print_r(session_id()."\n", true), FILE_APPEND);
ini_set('session.cookie_lifetime', '86400');
//if(!session_id()) session_start();


//session_start();
//$_SESSION['aaaa'] = '1111111';



//echo '<pre>';
////print_r(session_id($_COOKIE['PHPSESSID']));
////print_r($_COOKIE);
//print_r($_SESSION);
//echo '</pre>';
//die();

require_once __DIR__ . '/vendor/autoload.php';

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);



$responseFactory = new Laminas\Diactoros\ResponseFactory();

$strategy = new League\Route\Strategy\JsonStrategy($responseFactory);
$router = (new League\Route\Router)->setStrategy($strategy);

$router->map('POST', '/login', '\app\api\v1\Users::authUser');
$router->map('POST', '/registration', '\app\api\v1\Users::registration');
$router->map('GET', '/get-user', '\app\api\v1\Users::getUser');

/** @var Laminas\Diactoros\Response $response */

$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
