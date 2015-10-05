<?php

namespace Feedler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class Framework
{
    protected $matcher;
    protected $resolver;
    protected $generator;

    public function __construct(
        UrlMatcher $matcher,
        ControllerResolver $resolver,
        UrlGenerator $generator
    ) {
        $this->matcher = $matcher;
        $this->resolver = $resolver;
        $this->generator = $generator;
    }

    public function handle(Request $request)
    {
        $this->matcher->getContext()->fromRequest($request);

        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));

            $controller = $this->resolver->getController($request);
            $controller[0]->setGenerator($this->generator);
            $arguments = $this->resolver->getArguments($request, $controller);

            return call_user_func_array($controller, $arguments);
        } catch (Routing\Exception\ResourceNotFoundException $e) {
            return new Response('Страница не найдена!',  404);
        } catch (Exception $e) {
            return new Response(
                'Возникла ошибка:<br/>'.$e->getMessage(),
                500
            );
        }
    }
}
