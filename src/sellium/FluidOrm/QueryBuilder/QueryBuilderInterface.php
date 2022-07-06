<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\QueryBuilder;

use Sellium\FluidOrm\QueryBuilder\Manupulation\DeleteQuery;
use Sellium\FluidOrm\QueryBuilder\Manupulation\InsertQuery;
use Sellium\FluidOrm\QueryBuilder\Manupulation\SelectQuery;
use Sellium\FluidOrm\QueryBuilder\Manupulation\UpdateQuery;

/**
* QueryBuilderInterface Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
interface QueryBuilderInterface
{
    /**
     * Return insert query
     *
     * @param array $data
     * @return InsertQuery
     */
    public function insert(array $data): InsertQuery;

    /**
     * Return select query
     *
     * @param string ...$args
     * @return SelectQuery
     */
    public function select(string ...$args): SelectQuery;

    /**
     * Return delete query
     *
     * @return DeleteQuery
     */
    public function delete(): DeleteQuery;

    /**
     * Return update query
     *
     * @param string $table
     * @return UpdateQuery
     */
    public function update(string $table): UpdateQuery;
}
