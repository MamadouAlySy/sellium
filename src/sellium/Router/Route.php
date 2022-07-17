<?php

declare(strict_types=1);

namespace Sellium\Router;

/**
* Route Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
class Route implements RouteInterface
{
    /**
     * Controller name
     *
     * @var string
     */
    private string $controllerName;

    /**
     * Controller action name
     *
     * @var string
     */
    private string $controllerActionName;

    /**
     * Other route parameters
     *
     * @var array
     */
    private array $parameters;

    public function __construct(string $controllerName, string $controllerActionName, array $parameters = [])
    {
        $this->controllerName = $controllerName;
        $this->controllerActionName = $controllerActionName;
        $this->parameters = $parameters;
    }

    /**
     * @inheritDoc
     */
    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    /**
     * @inheritDoc
     */
    public function setControllerName(string $controllerName): self
    {
        $this->controllerName = $controllerName;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getControllerActionName(): string
    {
        return $this->controllerActionName;
    }

    /**
     * @inheritDoc
     */
    public function setControllerActionName(string $controllerActionName): self
    {
        $this->controllerActionName = $controllerActionName;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @inheritDoc
     */
    public function setParameters(array $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }
}
