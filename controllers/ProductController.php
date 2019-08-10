<?php

class ProductController
{
    public function actionView($productId){
       $categoriesList = [];
       $categoriesList = Category::getCategoriesList(); 
       $product = Product::getProductById($productId);
       require_once ROOT . '/views/product/view.php';
       return true;
    }

}
