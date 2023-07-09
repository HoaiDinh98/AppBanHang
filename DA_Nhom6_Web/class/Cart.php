<?php

class Cart
{
    public function get( $pdo,$TenTk)
    {
        
        $query = "SELECT donhang.id,sanpham.HinhAnh,sanpham.TenSP,chitietdonhang.soluong,sanpham.DonGia,sanpham.DonGia 
        FROM donhang,taikhoan,chitietdonhang,sanpham 
        WHERE donhang.iduser = taikhoan.TenTK AND donhang.id = chitietdonhang.iddon and chitietdonhang.idsp = sanpham.MaSp";


        $sql = "SELECT donhang.id,donhang.iduser AS TENTK, donhang.sdt,donhang.diachi from donhang,taikhoan WHERE donhang.iduser = taikhoan.TenTK AND donhang.iduser = :TenTk ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':TenTk',$TenTk,PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    public function getcthd( $pdo,$iddon)
    {
        
        $query = "SELECT chitietdonhang.id as idct,donhang.id as iddon,chitietdonhang.idsp as idsp,sanpham.TenSP as tenSp,chitietdonhang.soluong as soluong, sanpham.DonGia as Dongia FROM chitietdonhang,donhang,sanpham
         WHERE chitietdonhang.iddon = :iddon2 AND chitietdonhang.idsp = sanpham.MaSp
         GROUP BY idct,iddon,idsp,tenSp,soluong,Dongia";

        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':iddon2', $iddon, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function add($pdo,$ProDuctID,$UserID,$Amount)
    {

        $sql = "INSERT INTO donhang(iduser,sdt,diachi) VALUES (:iduser,:sdt,:diachi)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':iduser', $ProDuctID, PDO::PARAM_STR);
        $stmt->bindParam(':sdt', $UserID, PDO::PARAM_STR);
        $stmt->bindParam(':diachi', $Amount, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function update($pdo,$ProDuctID,$UserID,$Amount)
    {
        $sql = "UPDATE tbl_cart SET Amount= :Amount WHERE UserID = :UserID AND ProDuctID = :ProDuctID";
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
        $sql = "DELETE FROM donhang
                WHERE iduser = :iduser AND id = :id";
       $stmt = $pdo->prepare($sql);
       $stmt->bindValue(':iduser', $UserID, PDO::PARAM_STR);
       $stmt->bindValue(':id', $ProDuctID, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deletectdh($pdo,$id)
    {
        $sql = "DELETE FROM chitietdonhang
                WHERE id = :id ";
       $stmt = $pdo->prepare($sql);
       $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAll($pdo,$UserID)
    {
        $sql = "DELETE FROM donhang WHERE iduser = :iduser";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':iduser', $UserID, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
