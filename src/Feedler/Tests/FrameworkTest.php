<?php

namespace Feedler\Tests;

use Feedler\Framework;

class FrameworkTest extends \PHPUnit_Framework_TestCase
{
    private $framework;

    private $urlMatcher;

    private $urlGenerator;

    private $controllerResolver;

    public function setUp()
    {
        $this->urlMatcher = $this->prophesize('Symfony\Component\Routing\Matcher\UrlMatcher');
        $this->urlGenerator = $this->prophesize('Symfony\Component\Routing\Generator\UrlGenerator');
        $this->controllerResolver = $this->prophesize('Symfony\Component\HttpKernel\Controller\ControllerResolver');

        $this->framework = new Framework($this->urlMatcher->reveal(), $this->controllerResolver->reveal(), $this->urlGenerator->reveal());
    }

    public function testHandleNotFoundException()
    {
        $requestContext = $this->prophesize('Symfony\Component\Routing\RequestContext');
        $request = $this->prophesize('Symfony\Component\HttpFoundation\Request')->reveal();
        $parameterBag = $this->prophesize('Symfony\Component\HttpFoundation\ParameterBag');
        $request->attributes = $parameterBag;

        $this->urlMatcher->getContext()
            ->willReturn($requestContext)
            ->shouldBeCalledTimes(1);

        $this->urlMatcher->match(null)
            ->willThrow(
                'Symfony\Component\Routing\Exception\ResourceNotFoundException'
            )
            ->shouldBeCalledTimes(1);

        $requestContext->fromRequest($request)
            ->shouldBeCalledTimes(1);

        $response = $this->framework->handle($request);
        $this->assertInstanceOf(
            'Symfony\Component\HttpFoundation\Response',
            $response
        );

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('Страница не найдена!', $response->getContent());
    }

    public function testHandleException()
    {
        $expectedMessage = 'Ожидаемая ошибка';

        $requestContext = $this->prophesize('Symfony\Component\Routing\RequestContext');
        $request = $this->prophesize('Symfony\Component\HttpFoundation\Request')->reveal();
        $parameterBag = $this->prophesize('Symfony\Component\HttpFoundation\ParameterBag');
        $request->attributes = $parameterBag;

        $this->urlMatcher->getContext()
            ->willReturn($requestContext)
            ->shouldBeCalledTimes(1);

        $this->urlMatcher->match(null)
            ->willThrow(
                new \Exception($expectedMessage)
            )
            ->shouldBeCalledTimes(1);

        $requestContext->fromRequest($request)
            ->shouldBeCalledTimes(1);

        $response = $this->framework->handle($request);
        $this->assertInstanceOf(
            'Symfony\Component\HttpFoundation\Response',
            $response
        );

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals('Возникла ошибка:<br/>'.$expectedMessage, $response->getContent());
    }
}
