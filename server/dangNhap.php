<?php
include "connect.php";
$tenTK = $_POST['TenTK'];
$matKhau = $_POST['MK'];

//check
$query = 'SELECT * FROM `taikhoan` WHERE `TenTK` = "' . $tenTK . '" AND `MK` = "' . $matKhau . '"';
$data = mysqli_query($conn, $query);
$numrow = mysqli_num_rows($data);
if ($numrow > 0) {
    $response ="Đăng nhập thành công";
} else {
    $response ="Tên tài khoản hoặc mật khẩu sai";
}
echo $response;
?>
