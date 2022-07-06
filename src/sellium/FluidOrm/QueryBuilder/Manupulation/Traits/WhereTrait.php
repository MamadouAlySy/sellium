<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\QueryBuilder\Manupulation\Traits;

/**
* WhereTrait Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
trait WhereTrait
{
    protected $conditions = [];
    protected $conditionsData = [];

    public function where(string $key, string $operator, mixed $value, string $type = 'AND'): static
    {
        $uniqueKey = uniqid($key . '_');
        $this->conditions[] = [$type, $key, $operator, ':' . $uniqueKey];
        $this->conditionsData[$uniqueKey] = $value;

        return $this;
    }

    public function orWhere(string $key, string $operator, mixed $value): static
    {
        return $this->where($key, $operator, $value, 'OR');
    }

    public function getWhereQueryString(): string
    {
        $sql = '';

        if (empty($this->conditions)) {
            return $sql;
        }

        foreach ($this->conditions as $condition) {
            $sql .= implode(' ', $condition) . " ";
        }

        $sql = trim($sql, 'AND');
        $sql = trim($sql, 'OR');

        return " WHERE $sql";
    }

    public function getConditionsData(): array
    {
        return $this->conditionsData;
    }
}
