<?php
require_once '../database/mysqlConnection.php';

function getDatabaseConnection() {
    return new mysqlConnection();
}
?>