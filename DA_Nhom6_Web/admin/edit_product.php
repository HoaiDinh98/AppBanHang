<?php
$id = $_GET['id'];
session_start();
require '../class/Database.php';
require '../class/Product.php';

$db = new Database();
$pdo = $db->getConnect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = new Product();
    $ProductID = $_POST['ProductID'];

    $ProductName = $_POST['ProductName'];
    $Price = $_POST['Price'];
    $ProductImage = $_POST['ProductImage'];
    $Amount = $_POST['Amount'];
    $ChiTiet = $_POST['ChiTiet'];
    $MaLoai = $_POST['MaLoai'];


    if ($product->update($pdo,$ProductID,$ProductName,$Amount,$ProductImage,$ChiTiet,$Price,$MaLoai)) {
        header("Location: listproduct.php");
        exit();
    } else {
        echo "Có lỗi xảy ra khi cập nhật sản phẩm";
    }

}else {
    $product = Product::getOneByID3($pdo, $id);
}

?>
<?php include 'header.php'; ?>

<div class="container-fluid" style="margin-top: 25vh;">
    <div class="card">
        <div class="card-header">
            <h2>Sửa Sản Phẩm</h2>
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                    <input type="hidden" name="ProductID" class="form-control" required
                        value="<?php echo $product['MaSp']; ?>" />
                </div>
                <div class="form-group">
                    <label for="">Tên Sản Phẩm</label>
                    <input type="text" name="ProductName" class="form-control" required
                        value="<?php echo $product['TenSP']; ?>" />
                    <span class="text-danger fw-bold"></span>
                </div>
                <div class="form-group">
                    <label for="">Ảnh Sản Phẩm</label>
                    <input type="text" name="ProductImage" class="form-control" required 
                    value="<?php echo $product['HinhAnh']; ?>" />
                    <span class="text-danger fw-bold"></span>
                </div>
                <div class="form-group">
                    <label for="">Chi Tiết Sản Phẩm</label>
                    <textarea type="text" name="ChiTiet"  rows="4"class="form-control" required
                        value="<?php echo $product['ChiTiet']; ?>"><?php echo $product['ChiTiet']; ?></textarea>
                    <span class="text-danger fw-bold"></span>
                </div>
                <div class="form-group">
                    <label for="">Giá Sản Phẩm</label>
                    <input type="number" name="Price" class="form-control" required
                        value="<?php echo $product['DonGia']; ?>" /> <span class="text-danger fw-bold"></span>
                </div>

                <div class="form-group">
                    <label for="">Số Lượng</label>
                    <input type="number" name="Amount" class="form-control" required
                        value="<?php echo $product['SoLuong']; ?>" /> <span class="text-danger fw-bold"></span>
                </div>
               
            <div class="form-group">
                <label for=""><span class="text-danger fw-bold" value="<?= $product['MaLoaiSP'] ?>"> Loại Đang chọn : <?php echo $product['TenLoaiSP'] ?></span></label>
                <select class="form-control" name="MaLoai">
                    <?php
                    $Cats = Product::getAllCat($pdo);
                    foreach ($Cats as $Cat) {
                        echo "<option value='{$Cat['MaLoaiSP']}'>{$Cat['TenLoaiSP']} </option>";

                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                    
                </div>
            <button style="margin-top: 17px;" name="submit" class="btn btn-success" type="submit">Sửa</button>
        
        </form>
            <button style="margin-top: 17px;color:white;" name="sbm" class="btn btn-success"><a
                    href="../admin/listproduct.php" style="margin-top: 17px;color:white;">Quay lại</a></button>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>