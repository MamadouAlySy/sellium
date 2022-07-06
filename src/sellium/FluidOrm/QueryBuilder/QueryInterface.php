<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\QueryBuilder;

/**
* QueryInterface Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
interface QueryInterface
{
    /**
     * Return the sql query
     *
     * @return string
     */
    public function getSql(): string;

    /**
     * returns all parameters
     *
     * @return array
     */
    public function getParameters(): array;
}
