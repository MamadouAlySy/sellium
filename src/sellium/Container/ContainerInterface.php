<?php

declare(strict_types=1);

namespace Sellium\Container;

/**
* ContainerInterface Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
interface ContainerInterface
{
    /**
     * Get and instance of the given id
     *
     * @param string $id
     * @return mixed
     */
    public function get(string $id): mixed;

    /**
     * Check if the id is registered
     *
     * @param string $id
     * @return boolean
     */
    public function has(string $id): bool;

    /**
     * Check if the id is registered as singleton
     *
     * @param string $id
     * @return boolean
     */
    public function isSingleton(string $id): bool;

    /**
     * register new id
     *
     * @param string $id
     * @param callable|string $resolver
     * @throws ContainerException
     * @throws ReflectionException
     * @return self
     */
    public function register(string $id, callable|string $resolver): self;

    /**
     * register new id as singleton
     *
     * @param string $id
     * @param callable|string|object $resolver
     * @throws ContainerException
     * @throws ReflectionException
     * @return self
     */
    public function registerAsSingleton(string $id, callable|string|object $resolver): self;

    /**
     * Autowire
     * 
     * @param string $id
     * @return object
     * @throws ContainerException
     * @throws ReflectionException
     * @return mixed 
     */
    public function autowire(string $id): mixed;

    /**
     * Resolve all the given dependencies
     * 
     * @param ReflectionParameter[] $parameters
     * @return object[]
     * @throws ContainerException
     * @return array
     */
    public function resolveDependencies(array $parameters): array;
}
