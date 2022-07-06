<?php

declare(strict_types=1);

namespace Sellium\DatabaseConnection;

use Exception;
use PDO;
use Sellium\DatabaseConnection\Exception\DatabaseConnectionException;

/**
* DatabaseConnection Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
class DatabaseConnection implements DatabaseConnectionInterface
{
    /**
     * PDO instance
     *
     * @var PDO|null
     */
    private ?PDO $pdoInstance = null;

    /**
     * Database credentials
     *
     * @var array
     */
    private array $credentials = [];

    /**
     * PDO attribute options
     *
     * @var array
     */
    private array $pdoOptions = [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    /**
     * @param array $credentials
     */
    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @inheritDoc
     */
    public function open(): PDO
    {
        if ($this->pdoInstance === null) {
            try {
                $this->pdoInstance = new PDO(
                    $this->credentials['dsn'],
                    $this->credentials['username'] ?? 'root',
                    $this->credentials['password'] ?? '',
                    $this->pdoOptions
                );
            } catch (Exception $e) {
                throw new DatabaseConnectionException($e->getMessage(), (int) $e->getCode());
            }
        }
        return $this->pdoInstance;
    }

    /**
     * @inheritDoc
     */
    public function close(): void
    {
        $this->pdoInstance = null;
    }
}
