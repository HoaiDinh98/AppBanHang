<?php
require '../class/Database.php';
require '../class/Product.php';
session_start();
$db = new Database();
    $pdo = $db->getConnect();
     $id = isset($_GET['id']) ? $_GET['id'] : null;
     if (!$id) {
         die("id không hợp lệ.");
     }
     $product = Product::getOneByID3($pdo, $id);
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $product = Product::delete($pdo,$id) ;
            header("Location: listproduct.php");

    }
?>
<?php include 'header.php'; ?>


<div class="container-fluid" style="margin-top: 25vh;">
    <h1 class="h3 mb-4 text-gray-800">Xóa sản phẩm</h1>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark" style="background-color:cadetblue">
                <tr>
                    <th>ID</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Tên sản phẩm</th>       
                    <th>Chi Tiết sản phẩm</th> 
                    <th>Tên Loại sản phẩm</th> 
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td><?php echo $product['MaSp']; ?></td>
                        <td>
                            <img style="width: 100px;" src="<?php echo $product['HinhAnh']; ?>">
                        </td>
                        <td><?php echo $product['TenSP']; ?></td>
                        <td style="width: 400px;"><?php echo $product['ChiTiet']; ?></td>
                        <td><?php echo $product['TenLoaiSP']; ?></td>
                        <td><?php echo  number_format($product['DonGia'], 0, ',','.') ?><sup>đ</sup></td>

                    </tr>
            </tbody>

        </table>
        <form method="post" class=" m-auto">
            <p>Bạn có chắc chắn muốn xóa?</p>
            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="listproduct.php" class="ntn btn-primary">Cancel</a>
        </form>

    </div>

</div>
<?php include 'footer.php'; ?>