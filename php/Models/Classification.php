<?php

namespace App\Models;

use App\Utils\Database;

class Classification extends Database
{
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
}
