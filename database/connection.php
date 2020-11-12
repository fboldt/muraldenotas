<?php
require_once 'localMysqlCredentials.php';
require_once 'remoteMysqlCredentials.php';
require_once 'mysqlConnection.php';
require_once 'localPostgresCredentials.php';
require_once 'remotePostgresCredentials.php';
require_once 'postgresConnection.php';

function runningLocal() {
    return ($_SERVER['SERVER_ADDR'] == "::1" || $_SERVER['SERVER_ADDR'] == "127.0.0.1");
}

function getDatabaseConnection() {
    /*
    if (runningLocal()) {
        $postgresCredentials = new LocalPostgresCredentials();
    } else {
        $postgresCredentials = new RemotePostgresCredentials();
    }
    return new PostgresConnection($postgresCredentials);
    /*/
    if (runningLocal()) {
        $mysqlCredentials = new LocalMysqlCredentials();
    } else {
        $mysqlCredentials = new RemoteMysqlCredentials();
    }
    return new MysqlConnection($mysqlCredentials);
    //*/
}
?>