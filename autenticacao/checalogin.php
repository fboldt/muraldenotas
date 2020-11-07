<?php
require_once 'login.php';

$login = new Login();
$login->checarLogin();
$usuario = $login->getUsuario();
echo json_encode($usuario);

?>