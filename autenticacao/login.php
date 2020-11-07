<?php
require_once 'database.php';

session_start();

class Login {
    private $database;
    private $login;
    private $senha;

    function __construct() {
        $this->database = new Database();
        $this->login = "";
        $this->senha = "";
    }

    private function sanitizeString($string) {
        return $this->database->sanitizeString($string);
    }

    private function sanitizaLogin() {
        if (isset($_POST['login'])) {
            $usernameWithoutWhiteSpaces = preg_replace("/\s+/", "", $_POST['username']);
            $this->login = $this->sanitizeString($usernameWithoutWhiteSpaces);
        }
    }

    private function sanitizaSenha() {
        if (isset($_POST['senha'])) {
            $passwordWithoutWhiteSpaces = preg_replace("/\s+/", "", $_POST['password']);
            $this->senha = $this->sanitizeString($passwordWithoutWhiteSpaces);
        }
    }

    static function loginNulo() {
        $resposta = array();
        $resposta['usid'] = 0;
        $resposta['login'] = "";
        return $resposta;
    }

    private function buscarUsuarioDoBanco() {
        $reposta = Self::loginNulo();
        $resultado = $this->database->buscarUsuarioDoBanco($this->login, $this->senha);
        echo "resultado ";
        print_r($resultado);
        if (sizeof($resultado) > 0) {
            $userObj = $resultado[0];
            $resposta['usid'] = $userObj['id'];
            $resposta['login'] = $userObj['login'];
        }
        return $resposta;
    }

    function checarLogin() {
        $this->sanitizaLogin();
        $this->sanitizaSenha();
        $resposta = $this->buscarUsuarioDoBanco();
        $_SESSION['usid'] = $resposta['usid'];
        $_SESSION['login'] = $resposta['login'];
    }

    // private function insertUserInDatabase() {
    //     return $this->databaseWrapper->insertUser($this->username, $this->password);
    // }

    // function insertUser() {
    //     $response = Self::loginNulo();
    //     $this->sanitizaCamposPost();
    //     $resultado = $this->insertUserInDatabase();
    //     if ($resultado) {
    //         $response = $this->checkCredentials();
    //     }
    //     return $response;
    // }

    static function checarCamposSessao() {
        return isset($_SESSION['usid']) && isset($_SESSION['login']);
    }

    static function camposSessaoValidos() {
        return ($_SESSION['usid'] > 0) && ($_SESSION['login'] != "");
    }

    static function usuarioLogado() {
        if (Self::checarCamposSessao() && Self::camposSessaoValidos()) {
            return $_SESSION['usid'];
        }
        return 0;
    }

    // function checarLogin() {
    //     $resposta = Self::loginNulo();
    //     $resposta['usid'] = $_SESSION['usid'];
    //     $resposta['login'] = $_SESSION['login'];
    //     return $resposta;
    // }

    static function destroy_session() {
        $_SESSION=array();
        if (session_id != "" || isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-2592000, '/');
        }
        session_destroy();
    }
}

?>
