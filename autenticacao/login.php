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

    static function checarCamposPost() {
        return isset($_POST['login']) && isset($_POST['senha']);
    }

    private function sanitizeString($string) {
        return $this->database->sanitizeString($string);
    }

    private function sanitizaCamposPost() {
        $usernameWithoutWhiteSpaces = preg_replace("/\s+/", "", $_POST['username']);
        $this->username = $this->sanitizeString($usernameWithoutWhiteSpaces);
        $passwordWithoutWhiteSpaces = preg_replace("/\s+/", "", $_POST['password']);
        $this->password = $this->sanitizeString($passwordWithoutWhiteSpaces);
    }

    static function loginNulo() {
        $resposta = array();
        $resposta['usid'] = 0;
        $resposta['login'] = "";
        return $resposta;
    }

    private function checarCamposLogin() {
        return !empty($this->login) && !empty($this->senha);
    }

    private function buscarUsuarioDoBanco() {
        return $this->database->buscarUsuarioDoBanco($this->login, $this->senha);
    }

    function checarLogin() {
        $response = Self::loginNulo();
        if (Self::checarCamposPost()) {
            $this->sanitizaCamposPost();
            if ($this->checarCamposLogin()) {
                $resultado = $this->buscarUsuarioDoBanco();
                if (sizeof($resultado) > 0) {
                    $userObj = $resultado[0];
                    $_SESSION['usid'] = $response['usid'] = $userObj['id'];
                    $_SESSION['login'] = $response['login'] = $userObj['login'];
                }
            }
        }
        if ($response['userid'] == 0 || $response['username'] == "") {
            Self::destroy_session();
        }
        return $response;
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
