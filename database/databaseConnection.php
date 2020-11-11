<?php
interface DatabaseConnection {
    function executeQuery($query);

    function queryResultToPhpArray($queryResult);

    function sanitizeString($var);
}
?>