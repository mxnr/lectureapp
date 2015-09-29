<?php

include __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/Feedler/Resources/routes/route.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$generator = new Routing\Generator\UrlGenerator($routes, $context);

$response = new Response();
ob_start();
try {
    include __DIR__.'/../src/Feedler/Resources/views/layout/header.php';
    include __DIR__.'/../src'.$matcher->match($request->getPathInfo())['view'];
    include __DIR__.'/../src/Feedler/Resources/views/layout/footer.php';
} catch (Routing\Exception\ResourceNotFoundException $e) {
    $response->setStatusCode(404);
    include __DIR__.'/../src/Feedler/Resources/views/404.php';
} catch (Exception $e) {
    echo 'ТЫ ВСЕ ПОЛОМАЛ!';
}

$content = ob_get_clean();
$response->setContent($content);
$response->send();
