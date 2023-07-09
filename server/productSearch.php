<?php
include "connect.php";
require "class/SanPham.php";
require "class/Product.php";
$search = $_POST['search'];
if ( empty($search)){
		$arr = [
		'success' => false,
		'message' => " khong thanh cong",
	];

}else
{


$query = "SELECT * FROM sanpham WHERE sanpham.TenSP LIKE '%".$search."%'";
$data = mysqli_query($conn, $query);
$result = array();
while ($row = mysqli_fetch_assoc($data)) {
	$result[] = ($row);
	// code...
}
if (!empty($result)) {
	$arr = [
		'success' => true,
		'message' => "thanh cong",
		'result' => $result
	];
}else{
	$arr = [
		'success' => false,
		'message' => " khong thanh cong",
		'result' => $result
	];
}
}
echo json_encode($arr);
?>