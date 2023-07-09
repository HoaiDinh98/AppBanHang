<?php 
include "connect.php";
require "class/SanPham.php";
require "class/Product.php";

$query = "SELECT sanpham.MaSp as masp,TenSP,HinhAnh,DonGia,ChiTiet FROM sanpham,loaisp WHERE sanpham.MaLoai = loaisp.MaLoaiSP and MaLoai = 2";
$data = mysqli_query($conn,$query);
$arrProduct = array();
while($row = mysqli_fetch_assoc($data)) {
    array_push($arrProduct, new SanPham(
        $row['masp'],
        $row['TenSP'],
        $row['HinhAnh'],
        $row['DonGia'],
        $row['ChiTiet']
    ));
}


echo json_encode($arrProduct,JSON_UNESCAPED_UNICODE);
?>