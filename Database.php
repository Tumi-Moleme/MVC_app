<?php

namespace app;

use PDO;

class Database
{
  public \PDO $pdo;

  public function __construct()
  {
    $this->pdo =  new
      PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function getProducts($search = '')
  {
    if ($search) {
      $stmt = $this->pdo->prepare('SELECT * FROM products WHERE title LIKE :title ORDER BY create_date DESC');
      $stmt->bindValue(":title", "%$search%");
    } else {
      $stmt = $this->pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');
    }

    $stmt->execute();
    return $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
