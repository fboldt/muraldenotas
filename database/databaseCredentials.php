<?php
interface DatabaseCredentials {
    function getHostname();
    function getDatabase();
    function getUsername();
    function getPassword();
}
?>