<?php

namespace App\Core;

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
    $config_file = __DIR__ . '/../../install/config.ini';
    $config = parse_ini_file($config_file, true);

    $config_db = $config['DB'];

    $this->host = $config_db['HOST'];
    $this->db = $config_db['DATABASE'];
    $this->user = $config_db['USER'];
    $this->password = $config_db['PASSWORD'];
    $this->charset = $config_db['CHARSET'];
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
