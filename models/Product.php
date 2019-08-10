<?php

class Product
{
    const SHOW_BY_DEFAULT = 3;

    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {        
        $count = intval($count);
        $db = Db::getConnection();
        $lastProductsList = [];
        
        $result = $db->query('SELECT id, name, price, image, is_new FROM product '
                . 'WHERE status = "1"'
                . 'ORDER BY id DESC '                
                . 'LIMIT ' . $count);
        
        return $lastProductsList = $result->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    public static function getProductsListByCategory($categoryId = false, $page = 1)
    {     
        if($categoryId){
            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
            
            $db = Db::getConnection();
            $productsByCategory = [];

            $result = $db->query("SELECT id, name, price, image, is_new FROM product "
                    . "WHERE status = '1' AND category_id = " . $categoryId . " "
                    . "ORDER BY id DESC "
                    . "LIMIT " . self::SHOW_BY_DEFAULT . " "
                    . "OFFSET " . $offset);

            return $productsByCategory = $result->fetchAll(PDO::FETCH_ASSOC);
        }  
    }
    
    public static function getProductById($productId){
        $db = Db::getConnection();
        
        $result = $db->query('SELECT * FROM product WHERE id = ' . $productId);

        return $product = $result->fetch(PDO::FETCH_ASSOC);
        
    }
    
    public static function getTotalProductsInCategory($categoryId){
        $db = Db::getConnection();
        
        $result = $db->query("SELECT count(id) AS count FROM product WHERE status = '1' AND category_id = " . $categoryId);
        $product = $result->fetch(PDO::FETCH_ASSOC);
        return $product['count'];
        
    }
    
     public static function getProdustsByIds($idsString)
    {
        $products = [];
        $db = Db::getConnection();
        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";
        $result = $db->query($sql);       
        return $products = $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function getRecommendProducts(){
        $db = Db::getConnection();
        $recommendProducts = [];
        
        $result = $db->query('SELECT id, name, price, image, is_new FROM product '
                . 'WHERE status="1" AND is_recommended = "1" ORDER BY id DESC');
        
        return $recommendProducts = $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function getProductsList(){
        $db = Db::getConnection();
        $result = $db->query("SELECT id, name, price, code FROM product ORDER BY id ASC");
        $productsList = [];
        return $productsList = $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function deleteProductById($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM product WHERE id = ?';
        $result = $db->prepare($sql);
        return $result->execute([$id]);
    }
    
    public static function createProduct($options)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO product '
                . '(name, code, price, category_id, brand, availability,'
                . 'description, is_new, is_recommended, status)'
                . 'VALUES '
                . '(:name, :code, :price, :category_id, :brand, :availability,'
                . ':description, :is_new, :is_recommended, :status)';
        $result = $db->prepare($sql); 
        if ($result->execute([':name' => $options['name'], 
                ':code' => $options['code'], 
                ':price' => $options['price'], 
                ':category_id' => $options['category_id'], 
                ':brand' => $options['brand'], 
                ':availability' => $options['availability'], 
                ':description' => $options['description'], 
                ':is_new' => $options['is_new'], 
                ':is_recommended' => $options['is_recommended'], 
                ':status' => $options['status']])) {
            return $db->lastInsertId();
        }
        return 0;
    }
    
    public static function updateProductById($id, $options)
    {
        $db = Db::getConnection();
        $sql = "UPDATE product SET 
                name = :name, 
                code = :code, 
                price = :price, 
                category_id = :category_id, 
                brand = :brand, 
                availability = :availability, 
                description = :description, 
                is_new = :is_new, 
                is_recommended = :is_recommended, 
                status = :status
            WHERE id = :id";
        $result = $db->prepare($sql);
        $data = [':id' => $id, 
                 ':name' => $options['name'],
                 ':code' => $options['code'],
                 ':price' => $options['price'],
                 ':category_id' => $options['category_id'], 
                 ':brand' => $options['brand'],
                 ':availability' => $options['availability'],
                 ':description' => $options['description'], 
                 ':is_new' => $options['is_new'], 
                 ':is_recommended' => $options['is_recommended'],
                 ':status' => $options['status']];
        return $result->execute($data);
    }
    
    public static function getImage($id)
    {
        $noImage = 'no-image.jpg';
        $path = '/upload/images/products/';
        $pathToProductImage = $path . $id . '.jpg';
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            return $pathToProductImage;
        }
        return $path . $noImage;
    }
    
}