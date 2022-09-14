<?php

namespace app\model;

use app\Database;
use app\helpers\UtilHelper;

class Product
{
  public ?int $id = null;
  public ?String $description = null;
  public ?String $title = null;
  public ?float $price = null;
  public ?array $imageFile = null;
  public ?String $imagePath = null;

  public function load($data)
  {
    $this->id = $data['id'] ?? null;
    $this->description = $data['description'] ?? null;
    $this->imageFile = $data['imageFile'] ?? null;
    $this->imagePath = $data['imagePath'] ?? null;
    $this->title = $data['title'];
    $this->price = $data['price'];
  }

  public function save()
  {
    $errors = [];

    if (empty($this->title)) {
      $errors[] = "Product title is required";
    }

    if (empty($this->price)) {
      $errors[] = "Product price is required";
    }

    // check if images folder is created
    if (!is_dir(__DIR__ . '/../public/assets/images')) {
      mkdir(__DIR__ . '/../public/assets/images');
    }

    if (empty($errors)) {


      if ($this->imageFile && $this->imageFile['tmp_name']) {

        if ($this->imagePath) {
          unlink(__DIR__ . '/../public/' . $this->imagePath);
        }
        $this->imagePath =
          "assets/images/" . UtilHelper::randomString(8) . '/' . $this->imageFile['name'];
        mkdir(dirname(__DIR__ . '/../public/' . $this->imagePath));

        move_uploaded_file($this->imageFile['tmp_name'], __DIR__ . '/../public/' . $this->imagePath);
      }
      $db = Database::$db;
      if ($db->id) {
        $db->updateProduct($this);
      } else {
        $db->createProduct($this);
      }
    }
    return $errors;
  }
}
