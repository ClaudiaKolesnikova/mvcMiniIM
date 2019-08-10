<?php

class Category
{
    public static function getCategoriesList(){
        $db = Db::getConnection();
        $categoriesList = [];
        
        $result = $db->query('SELECT id, name FROM category '
                . 'WHERE status = "1" '
                . 'ORDER BY sort_order ASC');

        return $categoriesList = $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function getCategoriesListAdmin()
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT id, name, sort_order, status FROM category '
                . 'ORDER BY sort_order ASC');
 
        $categoryList = [];
        
        return $categoryList = $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function deleteCategoryById($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM category WHERE id = ?';
        $result = $db->prepare($sql);
        return $result->execute([$id]);
    }

    public static function updateCategoryById($id, $name, $sortOrder, $status)
    {
        $db = Db::getConnection();
        $sql = "UPDATE category SET 
                name = :name, 
                sort_order = :sort_order, 
                status = :status
            WHERE id = :id";
        $result = $db->prepare($sql);
        return $result->execute([':name' => $name,
                                 ':sort_order' => $sortOrder,
                                 ':status' => $status,
                                 ':id' => $id]);
    }

    public static function getCategoryById($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM category WHERE id = ?';
        $result = $db->prepare($sql);
        $result->execute([$id]);

        return $result->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыта';
                break;
        }
    }
    
    public static function createCategory($name, $sortOrder, $status)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO category (name, sort_order, status) '
                . 'VALUES (?, ?, ?)';
        $result = $db->prepare($sql);
        return $result->execute([$name, $sortOrder, $status]);
    }

}