<?php
require '../class/Database.php';
require '../class/Product.php';

$db = new Database();
$pdo = $db->getConnect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $product = new Product();
    $ProductName = $_POST['ProductName'];
    $Price = $_POST['Price'];
    $ProductImage = $_POST['ProductImage'];
    $Amount = $_POST['Amount'];
    $ChiTiet = $_POST['ChiTiet'];
    $MaLoai = $_POST['MaLoai'];



    if ($product->create($pdo,$ProductName,$Amount,$ProductImage,$ChiTiet,$Price,$MaLoai)) {
        header("Location: listproduct.php");
    } else {
        echo 'Error creating product';
    }
}

?>

<?php include 'header.php'; ?>

<div class="container-fluid" style="margin-top: 25vh;">
    <div class="card">
        <div class="card-header">
            <h2>Thêm Sản Phẩm</h2>
        </div>

        <form method="POST" enctype="multipart/form-data" action="">
            <div class="form-group">
                <label for="">Tên Sản Phẩm</label>
                <input type="text" name="ProductName" class="form-control" />
                <span class="text-danger fw-bold"></span>
            </div>

            <div class="form-group">
                <label for="">Ảnh Sản Phẩm</label>
                <input type="text" name="ProductImage" class="form-control"> <span class="text-danger fw-bold"></span>
            </div>

            <div class="form-group">
                <label for="">Giá Sản Phẩm</label>
                <input type="number" name="Price" class="form-control" /> <span class="text-danger fw-bold"></span>
            </div>
            <div class="form-group">
                <label for="">Chi Tiết Sản Phẩm</label>
                <input type="text" name="ChiTiet" class="form-control" /> <span class="text-danger fw-bold"></span>
            </div>
            <div class="form-group">
                <label for="">Số Lượng</label>
                <input type="number" name="Amount" class="form-control" /> <span class="text-danger fw-bold"></span>
            </div>
            <div class="form-group">
                <label for=""> Loại Sản Phẩm</label>
                <select class="form-control" name="MaLoai">
                    <?php
                    $Cats = Product::getAllCat($pdo);
                    foreach ($Cats as $Cat) {
                        echo "<option value='{$Cat['MaLoaiSP']}'>{$Cat['TenLoaiSP']} </option>";

                    }
                    ?>
                </select>
            </div>

            <button style="margin-top: 17px;" name="sbm" class="btn btn-success" type="submit">Thêm</button>
           

        </form>
        <button style="margin-top: 17px;color:white;" name="sbm" class="btn btn-success" type="submit"><a
                    href="listproduct.php" style="margin-top: 17px;color:white;">Quay lại</a></button>
    </div>
</div>
<?php include 'footer.php'; ?>