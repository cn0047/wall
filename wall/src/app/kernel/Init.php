<?php

namespace Kernel;

class Init
{
    /**
     * Initialize MySql service.
     *
     * @return \PDO PDO instance.
     * @throws Exception\Di\ConfigNotFoundException
     */
    public static function mysql(): \PDO
    {
        $mysqlConf = Di::getInstance()->getConfig('mysql');

        return new \PDO(
            sprintf('mysql:host=%s;dbname=%s', $mysqlConf['host'], $mysqlConf['dbname']),
            $mysqlConf['user'],
            $mysqlConf['password']
        );
    }

    /**
     * Initialize MongoDB service.
     */
    public function mongodb()
    {
    }
}
