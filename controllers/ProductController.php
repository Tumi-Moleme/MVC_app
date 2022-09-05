<?php

namespace app\controllers;

use app\Router;

class ProductController
{

  public function index(Router $router)
  {
    $search = $_GET['search'] ?? '';
    $products = $router->db->getProducts();

    $router->renderView('products/index', [
      'products' => $products,
      'search'  => $search
    ]);
  }
  public function create(Router $router)
  {
    $errors = [];
    $product = [
      'errors' => [],
      'title' => '',
      'price' => '',
      'description' => ''

    ];
    $router->renderView('products/create', [
      'product' => $product,
      'errors' => $errors
    ]);
  }
  public function update(Router $router)
  {
    $router->renderView('products/index', [
      'products' => $products,
      'search'  => $search
    ]);
  }
  public function delete()
  {
    echo "delete";
  }
}
