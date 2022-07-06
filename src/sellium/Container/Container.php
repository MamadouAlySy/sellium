<?php

declare(strict_types=1);

namespace Sellium\Container;

use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;
use Sellium\Container\Exception\ContainerException;

/**
* Container Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
class Container implements ContainerInterface
{
    private array $entries = [];
    private array $singletons = [];

    /**
     * @inheritDoc
     */
    public function get(string $id): mixed
    {
        if ($id == $this::class) {
            return $this;
        }

        if ($this->isSingleton($id)) {
            return $this->singletons[$id];
        }

        if ($this->has($id)) {
            $entry = $this->entries[$id];
            if (is_callable($entry)) {
                return call_user_func_array($entry, [$this]);
            }
            $id = $entry;
        }

        if (!class_exists($id)) {
            throw new ContainerException("No entry was found for $id");
        }

        try {
            return $this->autowire($id);
        } catch (ReflectionException $e) {
            throw new ContainerException($e->getMessage());
        }
    }

    /**
     * @inheritDoc
     */
    public function has(string $id): bool
    {
        return array_key_exists($id, $this->entries);
    }

    /**
     * @inheritDoc
     */
    public function isSingleton(string $id): bool
    {
        return array_key_exists($id, $this->singletons);
    }

    /**
     * @inheritDoc
     */
    public function register(string $id, callable|string $resolver): self
    {
        $this->entries[$id] = $resolver;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function registerAsSingleton(string $id, callable|string|object $resolver): self
    {
        $this->singletons[$id] = match(true) {
            is_string($resolver) => $this->autowire($resolver),
            is_callable($resolver) => call_user_func_array($resolver, [$this]),
            default => $resolver
        };
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function autowire(string $id): mixed
    {
        // 1. Inspect the class that we are trying to get from the container
        $reflectionClass = new ReflectionClass($id);
        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException("Class $id is not instantiable.");
        }

        // 2. Inspect the constructor of the class
        $constructor = $reflectionClass->getConstructor();
        if (!$constructor) {
            return $reflectionClass->newInstanceWithoutConstructor();
        }

        // 3. Inspect the constructor parameters (dependencies)
        $parameters = $constructor->getParameters();
        if (!$parameters) {
            return $reflectionClass->newInstance();
        }

        // 4. If the constructor parameter is a class try to resole that class from the container
        $dependencies = $this->resolveDependencies($parameters);
        
        return $reflectionClass->newInstanceArgs($dependencies);
    }

    /**
     * @inheritDoc
     */
    public function resolveDependencies(array $parameters): array
    {
        return array_map(function (ReflectionParameter $param) {

            $this->verifyParameter($param);

            list($name, $type, $parentClass) = $this->getParameterInfo($param);

            if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
                return $this->get($type->getName());
            }

            throw new ContainerException(
                "Failed to resolve class $parentClass because of invalid param $name"
            );

        }, $parameters);
    }

    /**
     * @param ReflectionParameter $param
     * @throws ContainerException
     */
    private function verifyParameter(ReflectionParameter $param): void
    {
        list($name, $type, $parentClass) = $this->getParameterInfo($param);

        if (!$type) {
            throw new ContainerException(
                "Failed to resolve class $parentClass because param $name is missing a type hint."
            );
        }

        if ($type instanceof ReflectionUnionType) {
            throw new ContainerException(
                "Failed to resolve class $parentClass because of union type for param $name."
            );
        }
    }

    /**
     * Returns the parameter name, type and the parent class name
     *
     * @param ReflectionParameter $param
     * @return array[name, type, parentClass]
     */
    private function getParameterInfo(ReflectionParameter $param): array
    {
        return [
            $param->getName(),
            $param->getType(),
            $param->getDeclaringClass()->getName()
        ];
    }
}
