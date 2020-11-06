<?php
require_once '../testes/funcoes.php';
require_once 'login.php';

function checkLogin() {
    $login = new Login();
    verificaObjeto($login);
    
    $resposta = Login::loginNulo();
    verificaObjeto($resposta);

    echo "usuarioLogado<br>";
    verificaObjeto(Login::usuarioLogado());

    verificaObjeto(Login::checarCamposPost());

    verificaObjeto($login->checarLogin());

}

echo "teste login.php<br><br>";
checkLogin();

$formlogin = <<<STR
<form action="teste.php" method="POST">
    <input type="text" size="6" name="login" value="fulano">
    <input type="text" size="6" name="senha" value="123123">
    <input type="submit" value="login">
</form>
STR;
echo $formlogin;



?>