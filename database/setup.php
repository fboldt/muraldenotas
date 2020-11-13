<?php
require_once 'connection.php';
require_once '../extras/somentedesenvolvimento.php';

class DatabaseSetup {
  
  private $databaseConnection;

  function __construct(){
    $this->databaseConnection = getDatabaseConnection();
  }

  private function executeQuery($query) {
    echo "<br>";
    echo $query . ": ";
    $result = $this->databaseConnection->executeQuery($query);
    if ($result) {
      print_r($result);
    } else {
      echo "FALHA!!!";
    }
    echo "<br>";
  }

  function reset() {
    $this->clearDataset();
    $this->createTables();
    $this->insertExamples();
  }

  private function clearDataset() {
      $query = "DROP TABLE IF EXISTS mensagens";
      $this->executeQuery($query);
      $query = "DROP TABLE IF EXISTS usuarios";
      $this->executeQuery($query);
  }

  private function createTables() {
    $this->createTableUsuarios();
    $this->createTableMensagens();
  }

  private function createTableUsuarios() {
    $pkstr = $this->databaseConnection->autoincrementPrimaryKey();
    $query = "CREATE TABLE IF NOT EXISTS usuarios ( 
        id " . $pkstr . ", 
        login VARCHAR(16) NOT NULL UNIQUE, 
        senha VARCHAR(128) NOT NULL
    )";
    $this->executeQuery($query);
  }

  private function createTableMensagens() {
    $pkstr = $this->databaseConnection->autoincrementPrimaryKey();
    $defaultimestamp = $this->databaseConnection->defaultTimestamp();
    $query = "CREATE TABLE IF NOT EXISTS mensagens ( 
        id " . $pkstr . ", 
        usuid INT NOT NULL, 
        FOREIGN KEY (usuid) REFERENCES usuarios(id),
        texto VARCHAR(128) NOT NULL,
        tempo " . $defaultimestamp . " NOT NULL
    )";
    $this->executeQuery($query);
  }

  private function insertExamples() {
    $query = "INSERT INTO usuarios (login, senha) VALUES ('fulano', '123123')";
    $this->executeQuery($query);
    $query = "INSERT INTO mensagens (usuid, texto) VALUES (1,'Nota de exemplo.')";
    $this->executeQuery($query);
  }

}

$databaseSetup = new DatabaseSetup();
$databaseSetup->reset();

?>