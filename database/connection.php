<?php
require_once '../database/mysqlConnection.php';
require_once '../database/postgresConnection.php';


function getDatabaseConnection() {
    //*
    return new PostgresConnection();
    /*/
    return new MysqlConnection();
    //*/
}
?>