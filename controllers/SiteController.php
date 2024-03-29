<?php

class SiteController
{
    
   public function actionIndex(){
       $categoriesList = Category::getCategoriesList();
       $lastProductsList = Product::getLatestProducts(9);
       $recommendProducts = Product::getRecommendProducts();
       require_once ROOT . '/views/site/index.php';
       return true;
   }
   
   public function actionContact() {
        $userEmail = '';
        $userText = '';
        $result = false;
        if (isset($_POST['submit'])) {
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];
            $errors = false;
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }
            if ($errors == false) {
                $adminEmail = 'klavochka@mail.ru';
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Тема письма';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }
        require_once ROOT . '/views/site/contact.php';
        return true;
    }

}
