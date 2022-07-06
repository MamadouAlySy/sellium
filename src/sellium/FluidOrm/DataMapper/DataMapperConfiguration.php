<?php

declare(strict_types=1);

namespace Sellium\FluidOrm\DataMapper;

use Sellium\FluidOrm\DataMapper\Exception\DataMapperConfigurationException;

/**
* DataMapperConfiguration Class
*
* @version 1.0.0
* @author Mamadou Aly Sy <sy.aly.mamadou@gmail.com>
*/
class DataMapperConfiguration
{
    public function __construct(private array $configuration = [])
    {
        
    }

    /**
     * Get the credentials for the given driver
     *
     * @param string $driver
     * @throws DataMapperConfigurationException
     * @return array
     */
    public function getDatabaseCredentials(string $driver): array
    {
        $this->validateDriver($driver);
        $this->validateCredentials($driver);
        return $this->configuration[$driver];
    }

    /**
     * Validate credentials for the given driver
     *
     * @param string $driver
     * @throws DataMapperConfigurationException
     * @return void
     */
    private function validateCredentials(string $driver): void
    {
        $credentials = $this->configuration[$driver];

        if (!isset($credentials['dsn'])) {
            throw new DataMapperConfigurationException("Missing 'dsn' key on $driver driver configuration");
        }

        if (empty($credentials['dsn'])) {
            throw new DataMapperConfigurationException("'dsn' key can not be empty on $driver driver configuration");
        }
    }

    /**
     * Validate driver
     *
     * @param string $driver
     * @throws DataMapperConfigurationException
     * @return void
     */
    private function validateDriver(string $driver)
    {
        if (empty($driver)) {
            throw new DataMapperConfigurationException("Invalid driver diver can not be empty");
        }

        if (!isset($this->configuration[$driver])) {
            throw new DataMapperConfigurationException("Unsupported driver $driver. Make sure that $driver key is in the configuration file");
        }
    }
}
