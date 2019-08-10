<?php

class Order
{

    public static function save($userName, $userPhone, $userComment, $userId, $products)
    {
        $products = json_encode($products);
        $db = Db::getConnection();
        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) VALUES (?, ?, ?, ?, ?)';
        $result = $db->prepare($sql);
        return $result->execute([$userName, $userPhone, $userComment, $userId, $products]);
    }
    
    public static function getOrdersList()
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT id, user_name, user_phone, date, status FROM product_order ORDER BY id DESC');
        $ordersList = [];
        return $ordersList = $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Новый заказ';
                break;
            case '2':
                return 'В обработке';
                break;
            case '3':
                return 'Доставляется';
                break;
            case '4':
                return 'Выполнен';
                break;
        }
    }

    public static function getOrderById($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM product_order WHERE id = ?';
        $result = $db->prepare($sql);
        $result->execute([$id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function deleteOrderById($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM product_order WHERE id = ?';
        $result = $db->prepare($sql);
        return $result->execute([$id]);
    }

    public static function updateOrderById($id, $userName, $userPhone, $userComment, $date, $status)
    {
        $db = Db::getConnection();
        $sql = "UPDATE product_order SET 
                user_name = :user_name, 
                user_phone = :user_phone, 
                user_comment = :user_comment, 
                date = :date, 
                status = :status 
            WHERE id = :id";
        $result = $db->prepare($sql);
        return $result->execute([':id' => $id,
                                 ':user_name' => $userName,
                                 ':user_phone' => $userPhone,
                                 ':user_comment' => $userComment,
                                 ':date' => $date,
                                 ':status' => $status]);
    }

}
