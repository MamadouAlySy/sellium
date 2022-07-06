<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\DataMapper;

use Exception;
use PDO;
use PDOStatement;
use Sellium\DatabaseConnection\DatabaseConnectionInterface;
use Sellium\DatabaseConnection\Exception\DatabaseConnectionException;
use Sellium\FluidOrm\DataMapper\Exception\DataMapperException;

/**
* DataMapper Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
class DataMapper implements DataMapperInterface
{
    private ?PDOStatement $pdoStatement = null;

    /**
     * @param DatabaseConnectionInterface $databaseConnection
     */
    public function __construct(private DatabaseConnectionInterface $databaseConnection)
    {
        //
    }
    
    /**
     * @inheritDoc
     */
    public function prepare(string $sqlQuery): self
    {
        try {
            $connection = $this->databaseConnection->open();
            $this->pdoStatement = $connection->prepare($sqlQuery);
            return $this; 
        } catch (DatabaseConnectionException $e) {
            throw new DataMapperException("Unable to connect to the database");
        }
    }

    /**
     * @inheritDoc
     */
    public function bindParameters(array $parameters, bool $search = false): self
    {
        foreach ($parameters as $key => $value) {
            $this->pdoStatement->bindValue(':' . $key, $search ? $value : "%{$value}%", $this->getBindType($value));
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        if ($this->pdoStatement) {
            $this->pdoStatement->execute();
        }
    }

    /**
     * @inheritDoc
     */
    public function rowCount(): int
    {
        return $this->pdoStatement ? (int) $this->pdoStatement->rowCount() : 0;
    }

    /**
     * @inheritDoc
     */
    public function getOneResult(): object
    {
        return $this->pdoStatement ? $this->pdoStatement->fetch(PDO::FETCH_OBJ) : null;
    }

    /**
     * @inheritDoc
     */
    public function getAllResult(): array
    {
        return $this->pdoStatement ? $this->pdoStatement->fetchAll(PDO::FETCH_OBJ) : [];
    }

    /**
     * @inheritDoc
     */
    public function getLastInsertedId(): int
    {
        try {
            $connection = $this->databaseConnection->open();
            return (int) $connection->lastInsertId();
        } catch (DatabaseConnectionException $e) {
            throw new DataMapperException("Unable to connect to the database");
        }
    }

    /**
     * Return the correct pdo params for the given value
     *
     * @param mixed $value
     * @return integer
     */
    private function getBindType(mixed $value): int
    {
        return match(true) {
            is_bool($value) => PDO::PARAM_BOOL,
            is_int($value) => PDO::PARAM_INT,
            is_null($value) => PDO::PARAM_NULL,
            default => PDO::PARAM_STR
        };
    }
}
