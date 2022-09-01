<?php

namespace app\controllers;

use app\Router;

class ProductController
{

  public function index(Router $router)
  {
    $router->renderView('products/index');
  }
  public function create()
  {
    echo "create";
  }
  public function update()
  {
    echo "update";
  }
  public function delete()
  {
    echo "delete";
  }
}
