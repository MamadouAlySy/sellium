<?php

declare(strict_types=1);

namespace Sellium\Router;

use Exception;
use Sellium\Router\Exception\RouteNotFoundException;

/**
* Router Class
* 
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
class Router implements RouterInterface
{
    /**
     * Routing table (contain all routes)
     *
     * @var array
     */
    private array $routes = [];

    /**
     * Contain all parameters of the matched route
     * Note: In order to get matched parameters the match method should be called
     *
     * @var array
     */
    private array $matchedRouteParameters = [];

    /**
     * Controller suffix that's added to the controller name
     * e.g: UserController, HomeController, etc...
     *
     * @var string
     */
    // private string $controllerSuffifx = 'Controller';

    public function __construct() {}

    /**
     * @inheritDoc
     */
    public function add(string $route, array $parameters): void
    {
        $this->routes[$route] = $parameters;
    }

    /**
     * @inheritDoc
     */
    public function dispatch(string $url): RouteInterface
    {
        if ($this->match($url)) {
            $controllerName = $this->matchedRouteParameters['controller'];
            $controllerName = $this->transformToUpperCamelCase($controllerName);
            $namespace = $this->getNamespace();
            $controllerName = $namespace . $controllerName;
            $actionName = $this->matchedRouteParameters['action'];
            $actionName = $this->transformToCamelCase($actionName);
            unset($this->matchedRouteParameters['controller']);
            unset($this->matchedRouteParameters['action']);
            return new Route($controllerName, $actionName, $this->matchedRouteParameters);
        }
        throw new RouteNotFoundException();
    }

    /**
     * Check if the given url matches one of the routes in the routing table
     *
     * @param string $url
     * @return boolean
     */
    private function match(string $url): bool
    {
        foreach ($this->routes as $route => $parameters) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $parameters[$key] = $value;
                    }
                }
                $this->matchedRouteParameters = $parameters;
                return true;
            }
        }
        return false;
    }

    /**
     * Transform the given string to upper camel case
     *
     * @param string $string
     * @return string
     */
    private function transformToUpperCamelCase(string $string): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * Transform the given string to camel case
     *
     * @param string $string
     * @return string
     */
    private function transformToCamelCase(string $string): string
    {
        return lcfirst($this->transformToUpperCamelCase($string));
    }

    /**
     * Return the correct namespace
     *
     * @return string
     */
    public function getNamespace(): string
    {
        $namespace = "App\\Controller\\";
        if (array_key_exists('namespace', $this->matchedRouteParameters)) {
            $namespace = $this->matchedRouteParameters['namespace'] . "\\";
        }
        return $namespace;
    }
}
