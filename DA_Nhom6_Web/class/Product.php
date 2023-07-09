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
            $product= $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data = $product;
            return $data;
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
    public static function countAllCat($pdo)
    {
        $sql = "SELECT COUNT(*) FROM loaisp";
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

            $product= $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data = $product;
            return $data;
        }
    }
    public static function getOneByID4($pdo, $ProductID)
    {
        // $sql = "SELECT product.*, brand.BrandName FROM product INNER JOIN brand ON product.BrandID = brand.BrandID WHERE product.ProductID = :ProductID";
        // $sql = "SELECT * FROM tbl_product INNER JOIN tbl_categories ON tbl_product.CatID = tbl_categories.CatID WHERE tbl_product.ProductID=:ProductID";
        $sql = "SELECT * FROM sanpham INNER JOIN Loaisp ON sanpham.MaLoai = Loaisp.MaLoaiSP WHERE sanpham.Masp=:ProductID";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':ProductID', $ProductID, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetch();
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
    public static function getOneByID3($pdo,$Masp)
    {
        // $sql = "SELECT product.*, brand.BrandName FROM product INNER JOIN brand ON product.BrandID = brand.BrandID WHERE product.ProductID = :ProductID";
        $sql = "SELECT * FROM sanpham INNER JOIN Loaisp ON sanpham.MaLoai = Loaisp.MaLoaiSP WHERE sanpham.Masp=:Masp";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':Masp',$Masp, PDO::PARAM_INT);

        if ($stmt->execute()) {

            $product= $stmt->fetch(PDO::FETCH_ASSOC);
            $data = $product;
            return $data;
        }
    }
    public static function countAllBYID($pdo, $sanpham)
    {
        $sql = "SELECT COUNT(*) FROM sanpham INNER JOIN size ON sanpham.Masp=size.ProductID INNER JOIN tbl_size ON tbl_product_size.SizeID = tbl_size.SizeId WHERE tbl_product.ProductID = :ProductID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':sanpham', $sanpham, PDO::PARAM_INT);
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
    public function create($pdo,$TenSP,$SoLuong,$HinhAnh,$ChiTiet,$DonGia,$MaLoai)
    {
        $sql = "INSERT INTO `sanpham`(`TenSP`, `SoLuong`, `HinhAnh`, `ChiTiet`, `DonGia`, `MaLoai`) 
                VALUES (:TenSP,:SoLuong,:HinhAnh,:ChiTiet,:DonGia,:MaLoai)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':TenSP', $TenSP, PDO::PARAM_STR);
        $stmt->bindValue(':SoLuong', $SoLuong, PDO::PARAM_INT);
        $stmt->bindValue(':HinhAnh', $HinhAnh, PDO::PARAM_STR);
        $stmt->bindValue(':ChiTiet', $ChiTiet, PDO::PARAM_STR);
        $stmt->bindValue(':DonGia', $DonGia, PDO::PARAM_INT);
        $stmt->bindValue(':MaLoai', $MaLoai, PDO::PARAM_INT);
        $success = $stmt->execute();
        if ($success) {
            $this->ProductID = $pdo->lastInsertId();
        }
        return $success;
    }


    public function update($pdo,$MaSp,$TenSP,$SoLuong,$HinhAnh,$ChiTiet,$DonGia,$MaLoai)
    {
        $sql = "UPDATE sanpham 
        INNER JOIN loaisp ON sanpham.MaLoai = loaisp.MaLoaiSP 
        SET sanpham.TenSP = :TenSP, 
            sanpham.HinhAnh = :HinhAnh, 
            sanpham.ChiTiet = :ChiTiet, 
            sanpham.SoLuong = :SoLuong, 
            sanpham.DonGia = :DonGia,
            sanpham.MaLoai = :MaLoai
        WHERE sanpham.MaSp = :MaSp";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':MaSp', $MaSp, PDO::PARAM_INT);
        $stmt->bindValue(':TenSP', $TenSP, PDO::PARAM_STR);
        $stmt->bindValue(':SoLuong', $SoLuong, PDO::PARAM_INT);
        $stmt->bindValue(':ChiTiet', $ChiTiet, PDO::PARAM_STR);
        $stmt->bindValue(':HinhAnh', $HinhAnh, PDO::PARAM_STR);
        $stmt->bindValue(':DonGia', $DonGia, PDO::PARAM_INT);
        $stmt->bindValue(':MaLoai', $MaLoai, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
    }


    public static function delete($pdo, $MaSp)
    {
        $sql = "DELETE sanpham FROM sanpham WHERE sanpham.MaSp=:MaSp";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':MaSp',$MaSp, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
    }

    public static function getByPriceAsc($pdo, $limit, $offset) 
    {
        $sql = "SELECT * FROM sanpham INNER JOIN loaisp ON sanpham.MaLoai = loaisp.MaLoaiSP  ORDER BY sanpham.DonGia ASC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            $product= $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data = $product;
            return $data;
        }
    }
    
    public static function getByPriceDesc($pdo, $limit, $offset) 
    {
        $sql = "SELECT * FROM sanpham INNER JOIN loaisp ON sanpham.MaLoai = loaisp.MaLoaiSP ORDER BY sanpham.DonGia DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            $product= $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data = $product;
            return $data;
        }
    }
    public static function searchProducts($pdo, $search, $limit, $offset){
 
        $stmt = $pdo->prepare("SELECT * FROM sanpham WHERE Tensp LIKE :search LIMIT :limit OFFSET :offset");
      
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $product= $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data = $product;
            return $data;
        }
    }
    public static function countAllLike($pdo, $search)
    {
        $sql = "SELECT COUNT(*) FROM sanpham WHERE Tensp LIKE :search";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
    }
    public static function searchProductsCat($pdo, $search, $limit, $offset){
         
        $stmt = $pdo->prepare("SELECT * FROM sanpham INNER JOIN loaisp ON sanpham.MaLoai = loaisp.MaLoaiSP WHERE Tensp LIKE :search LIMIT :limit OFFSET :offset");
      
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $product= $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data = $product;
            return $data;
        }
    }
}