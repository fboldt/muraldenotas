<?php
chdir('../');
require_once 'autenticacao.php';

$autenticacao = new Autenticacao();
$autenticacao->checarAutenticacao();
$usuario = $autenticacao->getUsuario();
echo json_encode($usuario);

?>