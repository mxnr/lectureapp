<?php

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add(
    'index_page',
    new Routing\Route(
        '/',
        array('view' => '/Feedler/Resources/views/index_page.php')
    )
);
$routes->add(
    'help_page',
    new Routing\Route(
        '/page/help.html',
        array('view' => '/Feedler/Resources/views/help.php')
    )
);
$routes->add(
    'contacts_page',
    new Routing\Route(
        '/page/contacts.html',
        array('view' => '/Feedler/Resources/views/contacts.php')
    )
);
$routes->add(
    'feed',
    new Routing\Route(
        '/feed/{name}.html',
        array(
            'view' => '/Feedler/Resources/views/feed.php',
            '_controller' => 'Feedler\Controllers\FeedController::feedAction'
        )
    )
);

return $routes;
