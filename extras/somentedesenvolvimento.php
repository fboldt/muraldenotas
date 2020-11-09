<?php
function isLocalhost() {
    return ($_SERVER['SERVER_ADDR'] == "::1" || $_SERVER['SERVER_ADDR'] == "127.0.0.1");
}
if (!isLocalhost()) die("Esta página deve rodar somente no servidor de desenvolvimento.");
?>