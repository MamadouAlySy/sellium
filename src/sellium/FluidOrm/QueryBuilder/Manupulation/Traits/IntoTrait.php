<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\QueryBuilder\Manupulation\Traits;

/**
* IntoTrait Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
trait IntoTrait
{
    protected string $table;

    public function into(string $table): static
    {
        $this->table = $table;

        return $this;
    }

    public function getIntoQueryString(): string
    {
        return ' INTO ' . $this->table;
    }
}
