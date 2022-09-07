<?php

namespace app\controllers;

use app\model\Product;
use app\Router;

class ProductController
{

  public function index(Router $router)
  {
    $search = $_GET['search'] ?? '';
    $products = $router->db->getProducts($search);

    $router->renderView('products/index', [
      'products' => $products,
      'search'  => $search
    ]);
  }
  public function create(Router $router)
  {
    $errors = [];
    $productData = [
      'image' => '',
      'title' => '',
      'price' => '',
      'description' => ''

    ];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $productData['title'] = $_POST[''];
      $productData['description'] = $_POST['description'];
      $productData['price'] = $_POST['price'];
      $productData['imageFile'] = $_FILES['image'] ?? null;

      $product = new Product();
      $product->load($productData);
      $product->save();
      header('Location: /products');
      exit;
    }
    $router->renderView('products/create', [
      'product' => $productData,
      'errors' => $errors
    ]);
  }
  public function update(Router $router)
  {
    $router->renderView('product/index', [
      'products' => $product,
      'search'  => $search
    ]);
  }
  public function delete()
  {
    echo "delete";
  }
}
