<?php
require_once 'databaseCredentials.php';

class LocalMysqlCredentials implements DatabaseCredentials {
    function getHostname() {
        return 'localhost';
    }
    function getDatabase() {
        return 'muraldenotas';
    }
    function getUsername() {
        return 'francisco';
    }
    function getPassword() {
        return 'francisco';
    }
}
?>
