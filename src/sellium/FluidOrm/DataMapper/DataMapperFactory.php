<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\DataMapper;

use Sellium\DatabaseConnection\DatabaseConnectionInterface;
use Sellium\FluidOrm\DataMapper\Exception\DataMapperFactoryException;

/**
* DataMapperFactory Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
class DataMapperFactory
{
    public static function create(string $databaseConnectionClass): DataMapperInterface
    {
        $interface = DatabaseConnectionInterface::class;
        if (in_array($interface, class_implements($interface))) {
            $configuration = []; // FIXME: get data from the configuration file
            $dataMapperConfiguration = new DataMapperConfiguration($configuration);
            $credentials = $dataMapperConfiguration->getDatabaseCredentials('mysql');
            $connection = new $databaseConnectionClass($credentials);
            return new DataMapper($connection);
        }
        throw new DataMapperFactoryException("$databaseConnectionClass does not implement $interface");
    }
}
