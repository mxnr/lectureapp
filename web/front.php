<?php

include __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Feedler\Framework;

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/Feedler/Resources/routes/route.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$resolver = new HttpKernel\Controller\ControllerResolver();
$generator = new Routing\Generator\UrlGenerator($routes, $context);
$framework = new Framework($matcher, $resolver, $generator);
$response = $framework->handle($request);

$response->send();
