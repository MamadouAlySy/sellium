<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\QueryBuilder\Manupulation;

use Sellium\FluidOrm\QueryBuilder\Manupulation\Traits\FromTrait;
use Sellium\FluidOrm\QueryBuilder\Manupulation\Traits\LimitTrait;
use Sellium\FluidOrm\QueryBuilder\Manupulation\Traits\WhereTrait;
use Sellium\FluidOrm\QueryBuilder\Statement;

/**
* DeleteQuery Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
class DeleteQuery extends Statement
{
    use FromTrait;
    use WhereTrait;
    use LimitTrait;

    public function getSql(): string
    {
        return "DELETE"
            . $this->getFromQueryString()
            . $this->getWhereQueryString()
            . $this->getLimitQueryString()
        ;
    }

    public function getParameters(): array
    {
        return $this->getConditionsData();
    }
}
