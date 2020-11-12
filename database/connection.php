<?php

function getDatabaseConnection() {
    //*
    return getPostgresConnection();
    /*/
    return getMysqlConnection();
    //*/
}

function runningLocal() {
    return ($_SERVER['SERVER_ADDR'] == "::1" || $_SERVER['SERVER_ADDR'] == "127.0.0.1");
}

function getPostgresConnection() {
    if (runningLocal()) {
        require_once 'localPostgresCredentials.php';
        $postgresCredentials = new LocalPostgresCredentials();
    } else {
        require_once 'remotePostgresCredentials.php';
        $postgresCredentials = new RemotePostgresCredentials();
    }
    require_once 'postgresConnection.php';
    return new PostgresConnection($postgresCredentials);
}

function getMysqlConnection() {
    if (runningLocal()) {
        require_once 'localMysqlCredentials.php';
        $mysqlCredentials = new LocalMysqlCredentials();
    } else {
        require_once 'remoteMysqlCredentials.php';
        $mysqlCredentials = new RemoteMysqlCredentials();
    }
    require_once 'mysqlConnection.php';
    return new MysqlConnection($mysqlCredentials);
}

?>
