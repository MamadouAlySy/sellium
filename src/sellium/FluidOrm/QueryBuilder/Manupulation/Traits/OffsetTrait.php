<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\QueryBuilder\Manupulation\Traits;

/**
* OffsetTrait Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
trait OffsetTrait
{
    protected ?int $offset = null;

    public function offset(int $offset): static
    {
        $this->offset = $offset;

        return $this;
    }

    public function getOffsetQueryString(): string
    {
        return !is_null($this->offset) ? ' OFFSET ' . $this->offset : '';
    }
}
