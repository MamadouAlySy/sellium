<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\QueryBuilder\Manupulation\Traits;

/**
* FromTrait Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
trait FromTrait
{
    protected string $table;

    public function from(string $table): static
    {
        $this->table = $table;

        return $this;
    }

    public function getFromQueryString(): string
    {
        return ' FROM ' . $this->table;
    }
}
