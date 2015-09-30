<?php

include __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;

function render_template($request, $generator) {
    ob_start();
    include __DIR__.'/../src/Feedler/Resources/views/layout/header.php';
    include __DIR__.'/../src'.$request->attributes->get('view');
    include __DIR__.'/../src/Feedler/Resources/views/layout/footer.php';
    return new Response(ob_get_clean());
}

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/Feedler/Resources/routes/route.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$generator = new Routing\Generator\UrlGenerator($routes, $context);
$resolver = new HttpKernel\Controller\ControllerResolver();

try {
    $request->attributes->add($matcher->match($request->getPathInfo()));

    $controller = $resolver->getController($request);
    $arguments = $resolver->getArguments($request, $controller);

    $response = call_user_func($controller, $arguments);
} catch (Routing\Exception\ResourceNotFoundException $e) {
    $response = new Response('Страница не найдена!',  404);
} catch (Exception $e) {
    echo $e->getMessage();
    $response = new Response('ТЫ ВСЕ ПОЛОМАЛ!',  500);
}

$response->send();
