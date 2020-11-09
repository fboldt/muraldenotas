<?php
header('Access-Control-Allow-Origin: *');
chdir('../');
require_once 'autenticacao.php';

$autenticacao = new Autenticacao();
$autenticacao->insereUsuario();
$autenticacao->checarAutenticacao();
$usuario = $autenticacao->getUsuario();
echo json_encode($usuario);

?>