<?php

declare(strict_types=1);

namespace Sellium\DatabaseConnection;

use PDO;

/**
* DatabaseConnectionInterface Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
interface DatabaseConnectionInterface
{
    /**
     * Open a new connection to the database and return PDO instance
     *
     * @return PDO
     */
    public function open(): PDO;

    /**
     * Close the connection to the database
     *
     * @return void
     */
    public function close(): void;
}
