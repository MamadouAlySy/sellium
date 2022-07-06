<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\QueryBuilder\Manupulation;

use Sellium\FluidOrm\QueryBuilder\Manupulation\Traits\FromTrait;
use Sellium\FluidOrm\QueryBuilder\Manupulation\Traits\LimitTrait;
use Sellium\FluidOrm\QueryBuilder\Manupulation\Traits\OffsetTrait;
use Sellium\FluidOrm\QueryBuilder\Manupulation\Traits\WhereTrait;
use Sellium\FluidOrm\QueryBuilder\Statement;

/**
* SelectQuery Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
class SelectQuery extends Statement
{
    use FromTrait;
    use WhereTrait;
    use LimitTrait;
    use OffsetTrait;

    public function __construct(private array $fields)
    {
        //
    }

    public function getSql(): string
    {
        $fields = !empty($this->fields) ? implode(', ', $this->fields) : '*';
        return "SELECT $fields"
            . $this->getFromQueryString()
            . $this->getWhereQueryString()
            . $this->getLimitQueryString()
            . $this->getOffsetQueryString()
        ;
    }

    public function getParameters(): array
    {
        return $this->getConditionsData();
    }
}
