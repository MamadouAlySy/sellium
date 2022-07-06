<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\DataMapper;

use Sellium\DatabaseConnection\Exception\DatabaseConnectionException;

/**
* DataMapperInterface Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
interface DataMapperInterface
{
    /**
     * Prepare the sql query
     *
     * @param string $sqlQuery
     * @throws DatabaseConnectionException
     * @return self
     */
    public function prepare(string $sqlQuery): self;

    /**
     * Bind all given parameters to the prepared query
     *
     * @param array $parameters
     * @param boolean $search
     * @return self
     */
    public function bindParameters(array $parameters, bool $search = false): self;

    /**
     * Execute the prepared query
     *
     * @return void
     */
    public function execute(): void;

    /**
     * Return the number of row affected by the executed query
     *
     * @return integer
     */
    public function rowCount(): int;

    /**
     * Return only the one result
     * Note: if there are many results only the first one will be returned
     *
     * @return object
     */
    public function getOneResult(): object;

    /**
     * Return all result
     *
     * @return array
     */
    public function getAllResult(): array;

    /**
     * Return the last inserted id
     *
     * @throws DatabaseConnectionException
     * @return integer
     */
    public function getLastInsertedId(): int;
}
