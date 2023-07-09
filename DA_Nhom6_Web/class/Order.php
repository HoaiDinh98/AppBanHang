<?php

class Order
{

    public function __construct()
    {
    }
    public function get( $pdo,$id)
    {
        
        $query = "SELECT tbl_order.OrderID, tbl_product.ProductID,tbl_product.ProductName,tbl_product.Price,tbl_product.ProductImage,tbl_order.Amount as Amount ,tbl_user.id
        FROM tbl_order , tbl_product , tbl_user 
        WHERE tbl_order.ProDuctID = tbl_product.ProDuctID and tbl_order.UserID = tbl_user.id  and tbl_user.id = $id 
        GROUP BY tbl_product.ProductID , tbl_order.Amount, tbl_order.OrderID;";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }


    public function add($pdo,$ProDuctID,$UserID,$Amount)
    {

        $sql = "INSERT INTO tbl_order(ProDuctID,UserID,Amount) VALUES (:ProDuctID,:UserID,:Amount)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':ProDuctID', $ProDuctID, PDO::PARAM_INT);
        $stmt->bindValue(':UserID', $UserID, PDO::PARAM_INT);
        $stmt->bindValue(':Amount', $Amount, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function update($pdo,$ProDuctID,$UserID,$Amount)
    {
        $sql = "UPDATE tbl_order SET Amount= :Amount WHERE UserID = :UserID AND ProDuctID = :ProDuctID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':ProDuctID', $ProDuctID, PDO::PARAM_INT);
        $stmt->bindValue(':UserID', $UserID, PDO::PARAM_INT);
        $stmt->bindValue(':Amount', $Amount, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($pdo,$ProDuctID,$UserID)
    {
        $sql = "DELETE FROM tbl_order
                WHERE UserID = :UserID AND ProDuctID = :ProDuctID";
       $stmt = $pdo->prepare($sql);
       $stmt->bindValue(':ProDuctID', $ProDuctID, PDO::PARAM_INT);
       $stmt->bindValue(':UserID', $UserID, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    
    public function deleteAll($pdo,$UserID)
    {
        $sql = "DELETE FROM tbl_order WHERE UserID = :UserID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':UserID', $UserID, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
