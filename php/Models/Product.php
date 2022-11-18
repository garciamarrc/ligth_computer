<?php

namespace App\Models;

use App\Core\Database;

use PDO;

class Product extends Database
{
  private int $id;
  private string $model;
  private string $specs;
  private float $price;
  private int $id_classification;
  private int $views;
  private int $sells;
  private int $likes;

  public function __construct(string $model, string $specs, float $price, int $id_classification, int $views = 0, int $sells = 0)
  {
    parent::__construct();

    $this->model = $model;
    $this->specs = $specs;
    $this->price = $price;
    $this->id_classification = $id_classification;
    $this->views = $views;
    $this->sells = $sells;
  }

  public function save()
  {
    $statement = "INSERT INTO productos (modelo, especificaciones, precio, id_clasificacion, ventas)
    VALUES (:model, :specs, :price, :id_classification, :sells)";

    try {
      $query = $this->connect()->prepare($statement);
      $query->execute([
        'model' => $this->model,
        'specs' => $this->specs,
        'price' => $this->price,
        'id_classification' => $this->id_classification,
        'sells' => $this->sells,
      ]);
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function update()
  {
    $statement = "UPDATE productos
    SET modelo = :model, especificaciones = :specs, precio = :price, id_clasificacion = :id_classification, visitas = :views, ventas = :sells, likes = :likes
    WHERE id = :id";

    try {

      $query = $this->connect()->prepare($statement);
      $query->execute([
        'model' => $this->model,
        'specs' => $this->specs,
        'price' => $this->price,
        'id_classification' => $this->id_classification,
        'views' => $this->views,
        'sells' => $this->sells,
        'likes' => $this->likes,
        'id' => $this->id
      ]);
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public static function getRandom()
  {
    try {
      $db = new Database();
      $query = $db->connect()->query("SELECT * FROM productos ORDER BY RAND() LIMIT 1");

      $product = Product::createFromArray($query->fetch(PDO::FETCH_ASSOC));

      return $product;
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public static function find(int $id)
  {
    try {
      $db = new Database();
      $query = $db->connect()->query("SELECT * FROM productos WHERE id = '$id'");

      $row = $query->fetch(PDO::FETCH_ASSOC);

      if (!$row) return false;

      $product = Product::createFromArray($row);

      return $product;
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public static function readQuery(string $sql)
  {
    try {
      $db = new Database();
      $query = $db->connect()->query($sql);

      $rows = [];

      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $product = Product::createFromArray($row);
        array_push($rows, $product);
      }

      return $rows;
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public static function createFromArray(array $arr): Product
  {
    $product = new Product($arr['modelo'], $arr['especificaciones'], $arr['precio'], $arr['id_clasificacion'], $arr['visitas'], $arr['ventas']);
    $product->setId($arr['id']);
    $product->setLikes($arr['likes']);

    return $product;
  }

  public function setId(int $id)
  {
    $this->id = $id;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setModel(string $model)
  {
    $this->model = $model;
  }

  public function getModel()
  {
    return $this->model;
  }

  public function setSpecs(string $specs)
  {
    $this->specs = $specs;
  }

  public function getSpecs()
  {
    return $this->specs;
  }

  public function setPrice(float $price)
  {
    $this->price = $price;
  }

  public function getPrice()
  {
    return $this->price;
  }

  public function setIdClassification(int $id_classification)
  {
    $this->$id_classification = $id_classification;
  }

  public function getIdClassification()
  {
    return $this->id_classification;
  }

  public function setViews(float $views)
  {
    $this->views = $views;
  }

  public function getViews()
  {
    return $this->views;
  }

  public function setLikes(float $likes)
  {
    $this->likes = $likes;
  }

  public function getLikes()
  {
    return $this->likes;
  }
}
