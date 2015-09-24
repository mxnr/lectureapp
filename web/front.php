<?php

include __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
$response = new Response();

$page = $request->query->get('page', 'index_page');
$page = htmlspecialchars($page, ENT_QUOTES, 'UTF-8');

$fileName = sprintf(__DIR__.'/../src/Feedler/Resources/%s.php', $page);

ob_start();
if (file_exists($fileName)) {
    include __DIR__.'/../src/Feedler/Resources/layout/header.php';
    include $fileName;
    include __DIR__.'/../src/Feedler/Resources/layout/footer.php';
} else  {
    $response->setStatusCode(404);
    include __DIR__.'/../src/Feedler/Resources/404.php';
}
$content = ob_get_clean();
$response->setContent($content);
$response->send();
