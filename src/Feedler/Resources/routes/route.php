<?php

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add(
    'index_page',
    new Routing\Route(
        '/',
        array('_controller' => 'Feedler\Controllers\IndexController::indexAction')
    )
);
$routes->add(
    'help_page',
    new Routing\Route(
        '/page/help.html',
        array('_controller' => 'Feedler\Controllers\PageController::helpAction')
    )
);
$routes->add(
    'contacts_page',
    new Routing\Route(
        '/page/contacts.html',
        array('_controller' => 'Feedler\Controllers\PageController::contactsAction')
    )
);
$routes->add(
    'feed',
    new Routing\Route(
        '/feed/{name}.html',
        array('_controller' => 'Feedler\Controllers\FeedController::feedAction')
    )
);

return $routes;
