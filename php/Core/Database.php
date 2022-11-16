<?php

namespace App\Core;

use App\Helpers\Ini;
use PDO;
use PDOException;

class Database
{
  private string $host;
  private string $db;
  private string $user;
  private string $password;
  private string $charset;

  public function __construct()
  {
    $this->host = Ini::getVariable('DB', 'HOST');
    $this->db = Ini::getVariable('DB', 'DATABASE');
    $this->user = Ini::getVariable('DB', 'USER');
    $this->password = Ini::getVariable('DB', 'PASSWORD');
    $this->charset = Ini::getVariable('DB', 'CHARSET');
  }

  public function connect()
  {
    try {
      $connection = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
      $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
      ];

      $pdo = new PDO($connection, $this->user, $this->password, $options);
      return $pdo;
    } catch (PDOException $th) {
      throw $th;
    }
  }
}
