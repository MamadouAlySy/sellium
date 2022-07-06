<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\QueryBuilder;

/**
* Query Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
class Query implements QueryInterface
{
    /**
     * @param string $sql
     * @param array $parameters
     */
    public function __construct(private string $sql, private array $parameters)
    {
        
    }

    /**
     * @inheritDoc
     */
    public function getSql(): string
    {
        return $this->sql;
    }

    /**
     * @inheritDoc
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}
