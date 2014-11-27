<?php

namespace Dk\Bundle\SystemBundle\Tests;

use Doctrine\DBAL\Connection;

/**
 * Class FixturesLoaderTrait
 *
 * @package Dk\Bundle\SystemBundle\Tests
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
trait FixturesLoaderTrait
{
    /**
     * @param Connection $connection
     */
    public function clearFixtures($connection)
    {
        $dbPlatform = $connection->getDatabasePlatform();

        $connection->query('SET FOREIGN_KEY_CHECKS=0');

        foreach ($connection->getSchemaManager()->listTables() as $table) {
            $q = $dbPlatform->getTruncateTableSql($table->getName());
            $connection->executeUpdate($q);
        }

        $connection->query('SET FOREIGN_KEY_CHECKS=1');
    }
}
