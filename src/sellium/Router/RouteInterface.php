<?php

declare(strict_types=1);

namespace Sellium\Router;

/**
* RouteInterface Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
interface RouteInterface
{
    /**
     * Get the value of controllerName
     *
     * @return string
     */
    public function getControllerName(): string;

    /**
     * Set the value of controllerName
     *
     * @param string $controllerName
     *
     * @return self
     */
    public function setControllerName(string $controllerName): self;

    /**
     * Get the value of controllerActionName
     *
     * @return string
     */
    public function getControllerActionName(): string;

    /**
     * Set the value of controllerActionName
     *
     * @param string $controllerActionName
     *
     * @return self
     */
    public function setControllerActionName(string $controllerActionName): self;

    /**
     * Get the value of parameters
     *
     * @return array
     */
    public function getParameters(): array;

    /**
     * Set the value of parameters
     *
     * @param array $parameters
     *
     * @return self
     */
    public function setParameters(array $parameters): self;
}
