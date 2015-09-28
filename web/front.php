<?php

include __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
$response = new Response();

$map = array(
    '/' => __DIR__.'/../src/Feedler/Resources/index_page.php',
    '/page/help.html' => __DIR__.'/../src/Feedler/Resources/help.php',
    '/page/contacts.html' => __DIR__.'/../src/Feedler/Resources/contacts.php',
    '/feed/cats.html' => __DIR__.'/../src/Feedler/Resources/feed.php',
);

$path = $request->getPathInfo();
ob_start();
if(isset($map[$path])) {
    include __DIR__.'/../src/Feedler/Resources/layout/header.php';
    include $map[$path];
    include __DIR__.'/../src/Feedler/Resources/layout/footer.php';
} else {
    $response->setStatusCode(404);
    include __DIR__.'/../src/Feedler/Resources/404.php';
}

$content = ob_get_clean();
$response->setContent($content);
$response->send();
