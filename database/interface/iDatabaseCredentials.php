<?php
interface IDatabaseCredentials {
    function getHostname();
    function getDatabase();
    function getUsername();
    function getPassword();
}
?>