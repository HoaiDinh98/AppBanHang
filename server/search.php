<?php
    include "connect.php";
    require "class/SanPham.php";
    require "class/Product.php";
    $search = $_POST['search'];
    $query = "SELECT MaSp,TenSP,HinhAnh,DonGia,ChiTiet FROM `sanpham` WHERE `TenSP` LIKE '%".$search."%'";
    $data = mysqli_query($conn,$query);
    $arrProduct = array();
    while($row = mysqli_fetch_assoc($data)) {
        array_push($arrProduct, new SanPham(
            $row['MaSp'],
            $row['TenSP'],
            $row['HinhAnh'],
            $row['DonGia'],
            $row['ChiTiet']
        ));
    }
    
    echo json_encode($arrProduct($search),JSON_UNESCAPED_UNICODE);


?>