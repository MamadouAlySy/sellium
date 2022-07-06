<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\QueryBuilder\Manupulation;

use Sellium\FluidOrm\QueryBuilder\Manupulation\Traits\IntoTrait;
use Sellium\FluidOrm\QueryBuilder\Statement;

/**
* InsertQuery Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
class InsertQuery extends Statement
{
    use IntoTrait;

    public function __construct(private array $data)
    {
        
    }

    public function getSql(): string
    {
        $sql = 
        $keys = array_keys($this->data);
        $fields = '(`' . implode('`, `', $keys) . '`)';
        $values = '(:' . implode(', :', $keys) . ')';
        return 'INSERT' . $this->getIntoQueryString() . "$fields VALUES $values";
    }

    public function getParameters(): array
    {
        return $this->data;
    }
}
