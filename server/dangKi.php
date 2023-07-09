<?php
include "connect.php";
$tenTK = $_POST['TenTK'];
$matKhau = $_POST['MK'];
$TenKH = $_POST['TenKH'];
$SDT = $_POST['SDT'];
$diaChi = $_POST['DiaChi'];
$email = $_POST['Email'];



//check
$query = 'SELECT * FROM `taikhoan` WHERE `Email`  = "' . $email . '"';
$data = mysqli_query($conn, $query);
$numrow = mysqli_num_rows($data);
if ($numrow > 0) {
    $response ="email đã tồn tại";
} else {
    // thêm tài khoản
    $query = 'INSERT INTO `taikhoan`(`TenTK`, `MK`, `TenKH`, `SDT`, `DiaChi`, `Email`) VALUES ("' . $tenTK . '","' . $matKhau . '","' . $TenKH . '","' . $SDT . '","' . $diaChi . '","' . $email . '")';
    $data = mysqli_query($conn, $query);

    if ($data == true) {
        $response ="Tạo tài khoản thành công";
    } else {
        $response ="không thành công";
    }
}
echo $response;
?>
