<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\QueryBuilder\Manupulation\Traits;

/**
* LimitTrait Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
trait LimitTrait
{
    protected ?int $limit = null;

    public function limit(int $limit): static
    {
        $this->limit = $limit;

        return $this;
    }

    public function getLimitQueryString(): string
    {
        return !is_null($this->limit) ? ' LIMIT ' . $this->limit : '';
    }
}
