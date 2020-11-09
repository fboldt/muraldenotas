<?php
header('Access-Control-Allow-Origin: *');
chdir('../');
require_once 'autenticacao.php';

$autenticacao = new Autenticacao();
if (isset($_POST['login']) && isset($_POST['senha'])){
    $autenticacao->checarAutenticacao();
}
$usuario = $autenticacao->getUsuario();
echo json_encode($usuario);

?>