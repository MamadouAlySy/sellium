<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\QueryBuilder\Manupulation;

use Sellium\FluidOrm\QueryBuilder\Manupulation\Traits\LimitTrait;
use Sellium\FluidOrm\QueryBuilder\Manupulation\Traits\SetTrait;
use Sellium\FluidOrm\QueryBuilder\Manupulation\Traits\WhereTrait;
use Sellium\FluidOrm\QueryBuilder\Statement;

/**
* UpdateQuery Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
class UpdateQuery extends Statement
{
    use SetTrait;
    use WhereTrait;
    use LimitTrait;

    public function __construct(private string $table)
    {
        
    }

    public function getSql(): string
    {
        
        return "UPDATE " . $this->table
            . $this->getSetQueryString()
            . $this->getWhereQueryString()
            . $this->getLimitQueryString()
        ;
    }

    public function getParameters(): array
    {
        return array_merge($this->getSetData(), $this->getConditionsData());
    }
}
