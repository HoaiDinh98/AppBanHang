<?php

use Product as GlobalProduct;

class Product
{


    public $ProductID;
    public $ProductName;
    public $Price;
    public $SizeID;
    public $CatID;
    public $ProductImage;
    public $Amount;

    public function __construct($id = 0 , $name = '',$SizeID=0 ,$CatID=0, $price=0,$image='',$Amount=0)
    {
        $this->ProductID = $id;
        $this->ProductName = $name;
        $this->SizeID = $SizeID;
        $this->CatID = $CatID;
        $this->Price = $price;
        $this->ProductImage = $image;
        $this->Amount = $Amount;
    }


    public static function getALL($pdo){
        
        $sql = "SELECT DISTINCT * FROM sanpham  ";
        $stmt = $pdo->prepare($sql);
        
        
        if($stmt->execute()){
            $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data = $product;
            
        }
        else{
            $error = $stmt->errorInfo();
            var_dump($error);
        }
        return $data;
    }
    public static function getSpAndLoai($pdo){
        
        $sql = "SELECT sanpham.MaSp as masp,TenSP,HinhAnh,DonGia FROM sanpham,loaisp WHERE sanpham.MaLoai = loaisp.MaLoaiSP ";
        $stmt = $pdo->prepare($sql);
        
        
        if($stmt->execute()){
            $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data = $product;
            
        }
        else{
            $error = $stmt->errorInfo();
            var_dump($error);
        }
        return $data;
    }
    public static function getPage($pdo, $limit, $offset)
    {
        $sql = "SELECT * FROM sanpham INNER JOIN loaisp ON sanpham.MaLoai = loaisp.MaLoaiSP LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $product= $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data = $product;
            return $data;
        }
    }
    public static function getPage2($pdo, $limit, $offset)
    {
        $sql = "SELECT * FROM loaisp  LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'loaisp');
            return $stmt->fetchAll();
        }
    }

    public static function countAll($pdo)
    {
        $sql = "SELECT COUNT(*) FROM sanpham";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
    }
    public static function getAllCat($pdo)
    {
        $sql = "SELECT * FROM loaisp";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'loaisp');
            return $stmt->fetchAll();
        }
    }

    public static function getOneByID($pdo, $ProductID)
    {
        // $sql = "SELECT product.*, brand.BrandName FROM product INNER JOIN brand ON product.BrandID = brand.BrandID WHERE product.ProductID = :ProductID";
        $sql = "SELECT sanpham.*, tbl_size.SizeName,tbl_product_size.Amount FROM sanpham INNER JOIN tbl_product_size ON tbl_product.ProductID=tbl_product_size.ProductID INNER JOIN tbl_size ON tbl_product_size.SizeID = tbl_size.SizeId WHERE tbl_product.ProductID = :ProductID";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':ProductID', $ProductID, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'tbl_product');
            return $stmt->fetch();
        }
    }
    public static function getOneByID3($pdo, $ProductID)
    {
        // $sql = "SELECT product.*, brand.BrandName FROM product INNER JOIN brand ON product.BrandID = brand.BrandID WHERE product.ProductID = :ProductID";
        $sql = "SELECT * FROM tbl_product INNER JOIN categories ON tbl_product.CatID = categories.CatID WHERE tbl_product.ProductID=:ProductID";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':ProductID', $ProductID, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'tbl_product');
            return $stmt->fetch();
        }
    }
    public static function countAllBYID($pdo, $ProductID)
    {
        $sql = "SELECT COUNT(*) FROM tbl_product INNER JOIN tbl_product_size ON tbl_product.ProductID=tbl_product_size.ProductID INNER JOIN tbl_size ON tbl_product_size.SizeID = tbl_size.SizeId WHERE tbl_product.ProductID = :ProductID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':ProductID', $ProductID, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
    }
    public static function getByID($pdo, $ProductID)
    {
        // $sql = "SELECT product.*, brand.BrandName FROM product INNER JOIN brand ON product.BrandID = brand.BrandID WHERE product.ProductID = :ProductID";
        $sql = "SELECT tbl_product.*, tbl_size.SizeName,tbl_product_size.Amount FROM tbl_product INNER JOIN tbl_product_size ON tbl_product.ProductID=tbl_product_size.ProductID INNER JOIN tbl_size ON tbl_product_size.SizeID = tbl_size.SizeId WHERE tbl_product.ProductID = :ProductID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':ProductID', $ProductID, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'tbl_product');
            return $stmt->fetch();
        }
    }
    public function create($pdo,$ProductName,$CatID,$Price,$ProductImage,$Amount)
    {
        $sql = "INSERT INTO tbl_product( ProductName, CatID, Price, ProductImage, Amount) 
                VALUES (:ProductName,:CatID,:Price,:ProductImage,:Amount)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':ProductName', $ProductName, PDO::PARAM_STR);
        $stmt->bindValue(':CatID', $CatID, PDO::PARAM_INT);
        $stmt->bindValue(':Price', $Price, PDO::PARAM_INT);
        $stmt->bindValue(':ProductImage', $ProductImage, PDO::PARAM_STR);
        $stmt->bindValue(':Amount', $Amount, PDO::PARAM_INT);
        $success = $stmt->execute();
        if ($success) {
            $this->ProductID = $pdo->lastInsertId();
        }
        return $success;
    }


    public function update($pdo,$ProductID,$ProductName,$CatID,$Price,$ProductImage,$Amount)
    {
        $sql = "UPDATE tbl_product 
                    INNER JOIN categories ON tbl_product.CatID = categories.CatID 
                    SET tbl_product.ProductName = :ProductName, 
                        tbl_product.CatID = :CatID, 
                        tbl_product.Price = :Price, 
                        tbl_product.ProductImage = :ProductImage, 
                        tbl_product.Amount = :Amount
                    WHERE tbl_product.ProductID = :ProductID";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':ProductID', $ProductID, PDO::PARAM_INT);
        $stmt->bindValue(':ProductName', $ProductName, PDO::PARAM_STR);
        $stmt->bindValue(':CatID', $CatID, PDO::PARAM_INT);
        $stmt->bindValue(':Price', $Price, PDO::PARAM_INT);
        $stmt->bindValue(':ProductImage', $ProductImage, PDO::PARAM_STR);
        $stmt->bindValue(':Amount', $Amount, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
    }


    public static function delete($pdo, $ProductID)
    {
        $sql = "DELETE tbl_product FROM tbl_product WHERE tbl_product.ProductID=:ProductID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':ProductID',  $ProductID, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
    }

    public static function getByPriceAsc($pdo, $limit, $offset) 
    {
        $sql = "SELECT * FROM sanpham INNER JOIN loaisp ON sanpham.MaLoai = loaisp.MaLoaiSP ORDER BY sanpham.dongia ASC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'sanpham');
            return $stmt->fetchAll();
        }
    }
    
    public static function getByPriceDesc($pdo, $limit, $offset) 
    {
        $sql = "SELECT * FROM sanpham INNER JOIN loaisp ON sanpham.MaLoai = loaisp.MaLoaiSP ORDER BY sanpham.dongia DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'sanpham');
            return $stmt->fetchAll();
        }
    }
    public static function searchProducts($pdo, $search, $limit, $offset){
 
        $stmt = $pdo->prepare("SELECT * FROM tbl_product WHERE ProductName LIKE :search LIMIT :limit OFFSET :offset");
      
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'tbl_product');
            return $stmt->fetchAll();
        }
    }
    public static function searchProductsCat($pdo, $search, $limit, $offset){
         
        $stmt = $pdo->prepare("SELECT * FROM tbl_product INNER JOIN categories ON tbl_product.CatID = categories.CatID WHERE ProductName LIKE :search LIMIT :limit OFFSET :offset");
      
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'tbl_product');
            return $stmt->fetchAll();
        }
    }
}