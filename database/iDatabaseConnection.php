<?php
interface IDatabaseConnection {
    function executeQuery($query);
    function queryResultToPhpArray($queryResult);
    function sanitizeString($var);
    function autoincrementPrimaryKey();
    function defaultTimestamp();
}
?>