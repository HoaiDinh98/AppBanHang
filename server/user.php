<?php
    include "connect.php";
    require "class/User.php";
    $tenTK = $_POST['TenTK'];
    $query = 'SELECT TenTK,MK,TenKH,SDT,DiaChi,Email FROM `taikhoan` WHERE `TenTK` = "' . $tenTK . '"';
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $str = "" . $row["TenTK"]. "!" . $row["MK"]. "!"
        . $row["TenKH"]. "!". $row["SDT"]. "!". $row["DiaChi"]."!". $row["Email"]."";
        }
    } else $str = 'error';
    echo $str;
?>