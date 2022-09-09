<?php

namespace app;

use app\model\Product;
use PDO;

class Database
{
  public \PDO $pdo;
  public static Database $db;

  public function __construct()
  {
    $this->pdo =  new
      PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    self::$db = $this;
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
  public function createProduct(Product $product)
  {
    $stmt = $this->pdo->prepare("INSERT INTO products 
  (title, image,description, price, create_date )
  VALUES (?,?,?,?,?)");

    $stmt->bindValue(1, $product->title);
    $stmt->bindValue(2, $product->imagePath);
    $stmt->bindValue(3, $product->description);
    $stmt->bindValue(4, $product->price);
    $stmt->bindValue(5, date('Y-m-d H:i:s'));

    $stmt->execute();
    // let user know if product was created
    header('Location: index.php');
  }
  public function deleteProduct($id)
  {
    // Prepare statement
    $stmt = $this->pdo->prepare('DELETE FROM products WHERE id = :id ');
    // bind parameters to the sql statement
    $stmt->bindValue(':id', $id);
    $stmt->execute();
  }
  public function getProductById($id)
  {
    $stmt = $this->pdo->prepare('SELECT * FROM products WHERE id = :id ');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
