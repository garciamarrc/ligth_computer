<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Classification extends Database
{
  private int $id;
  private string $name;
  private string $sub_classification;

  public function __construct(string $name, string $sub_classification)
  {
    parent::__construct();

    $this->name = $name;
    $this->sub_classification = $sub_classification;
  }

  public function save()
  {
    try {
      $statement = "INSERT INTO clasificacion (nombre, clasificacion_hija) VALUES (:name, :sub_clasification)";
      $query = $this->connect()->prepare($statement);
      $query->execute([
        'name' => $this->name,
        'sub_clasification' => $this->sub_classification
      ]);
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public static function getAll()
  {
    try {
      $db = new Database();
      $query = $db->connect()->query("SELECT * FROM clasificacion");

      $classifications = [];

      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $classification = Classification::createFromArray($row);
        array_push($classifications, $classification);
      }

      return $classifications;
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public static function getRandom()
  {
    try {
      $db = new Database();
      $query = $db->connect()->query("SELECT * FROM clasificacion ORDER BY RAND(id) LIMIT 1");

      $classification = Classification::createFromArray($query->fetch(PDO::FETCH_ASSOC));

      return $classification;
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public static function createFromArray($arr): Classification
  {
    $classification = new Classification($arr['nombre'], $arr['clasificacion_hija']);
    $classification->setId($arr['id']);

    return $classification;
  }

  public function setId(int $id)
  {
    $this->id = $id;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setName(string $name)
  {
    $this->name = $name;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setSubClassification(string $sub_classification)
  {
    $this->sub_classification = $sub_classification;
  }

  public function getSubClassification()
  {
    return $this->sub_classification;
  }
}
