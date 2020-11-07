<?php
require_once '../testes/funcoes.php';
require_once 'login.php';

function checkLogin() {
    $login = new Login();
    verificaObjeto($login);

    echo "getUsuario: ";
    print_r($login->getUsuario());
    echo "checar login<br>";
    $login->checarLogin();
    echo "getUsuario: ";
    print_r($login->getUsuario());

}

echo "teste login.php<br><br>";
checkLogin();

$formlogin = <<<STR
<form action="checalogin.php" method="POST">
<input type="text" size="6" name="login" value="cicrano">
<input type="text" size="6" name="senha" value="123456">
    <input type="submit" value="login">
</form>
STR;
echo $formlogin;

$formsignup = <<<STR
<form action="insereusuario.php" method="POST">
    <input type="text" size="6" name="login" value="cicrano">
    <input type="text" size="6" name="senha" value="123456">
    <input type="submit" value="signup">
</form>
STR;
echo $formsignup;

?>