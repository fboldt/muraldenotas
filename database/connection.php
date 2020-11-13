<?php

function getDatabaseConnection() {
    //*
    return getConnection('postgres');
    /*/
    return getConnection('mysql');
    //*/
}

function runningLocal() {
    return ($_SERVER['SERVER_ADDR'] == "::1" || $_SERVER['SERVER_ADDR'] == "127.0.0.1");
}

function getConnection($dbms) {
    $basedir = '../database/';
    if (runningLocal()) {
        $dbmsCredentials = $basedir . $dbms . '/localCredentials.php';
    } else {
        $dbmsCredentials = $basedir . $dbms . '/remoteCredentials.php';
    }
    require_once $dbmsCredentials;
    $databaseCredentials = new databaseCredentials();
    require_once $dbms . '/connection.php';
    return new DatabaseConnection($databaseCredentials);
}

?>
