<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\QueryBuilder;

/**
* Statement Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
abstract class Statement
{
    abstract public function getSql(): string; 
    abstract public function getParameters(): array;

    public function getQuery()
    {
        return new Query($this->getSql(), $this->getParameters());
    }
}
