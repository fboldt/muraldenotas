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
    require_once 'postgresConnection.php';
    if (runningLocal()) {
        require_once 'localPostgresCredentials.php';
        $postgresCredentials = new LocalPostgresCredentials();
    } else {
        require_once 'remotePostgresCredentials.php';
        $postgresCredentials = new RemotePostgresCredentials();
    }
    return new PostgresConnection($postgresCredentials);
}

function getMysqlConnection() {
    require_once 'mysqlConnection.php';
    if (runningLocal()) {
        require_once 'localMysqlCredentials.php';
        $mysqlCredentials = new LocalMysqlCredentials();
    } else {
        require_once 'remoteMysqlCredentials.php';
        $mysqlCredentials = new RemoteMysqlCredentials();
    }
    return new MysqlConnection($mysqlCredentials);
}

?>
