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
}
