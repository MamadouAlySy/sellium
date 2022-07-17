<?php

declare(strict_types=1);

namespace Sellium\Router;

use Sellium\Router\Exception\RouteNotFoundException;

/**
* RouterInterface Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
interface RouterInterface
{
    /**
     * Add new route to the routing table
     *
     * @param string $route
     * @param array $parameters
     * @return void
     */
    public function add(string $route, array $parameters): void;

    /**
     * Dispatch route and create the right controller and execute the right method
     *
     * @param string $url
     * @return RouteInterface
     * @throws RouteNotFoundException if there is no route that matches the given url 
     */
    public function dispatch(string $url): RouteInterface;
}
