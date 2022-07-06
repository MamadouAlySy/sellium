<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\QueryBuilder\Manupulation\Traits;

/**
* SetTrait Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
trait SetTrait
{
    protected array $setData;

    public function set(array $setData): static
    {
        $this->setData = $setData;
        return $this;
    }

    public function getSetQueryString(): string
    {
        $sql = '';
        foreach ($this->setData as $key => $value) {
            $sql .=  "$key = :$key, ";
        }
        var_dump($sql);
        return " SET " . substr($sql, 0, -2);
    }

    public function getSetData(): array
    {
        return $this->setData;
    }
}
