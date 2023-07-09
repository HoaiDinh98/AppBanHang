<?php
session_start();
require '../class/Product.php';
require '../class/Database.php';
$db = new Database();
$pdo = $db->getConnect();
//  $data = Product::getAll($pdo);



$perPage = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;
$limit = $perPage;
$data = Product::getPage($pdo, $limit, $offset);
$totalProducts = Product::countAll($pdo);
$totalPages = ceil($totalProducts / $perPage);
?>

<?php include 'header.php' ;?>   

<div class="container-fluid" style="margin-top: 25vh;">
    <h1 class="h3 mb-4 text-gray-800">Danh Sách Sản Phẩm</h1>
    <div style="width: 200px;"> 
    <form action="listproduct_search.php?" method="GET" class="d-flex">
        <input class="" id="search2" name="search2" type="search2" placeholder="tìm kiếm sản phẩm" aria-label="Search" >
        <button class="btn btn-outline-dark" type="submit">  Search</button>
    </form>
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark" style="background-color:cadetblue">
                <tr>
                    <th>ID</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>chi tiết sản phẩm</th>                
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Loại sản phẩm</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as  $product) : ?>
                    <tr>
                        <td><?php echo $product['MaSp']; ?></td>
                        <td>
                            <img style="width: 100px;" src="<?php echo $product['HinhAnh']; ?>">
                        </td>
                        <td><?php echo  $product['TenSP']; ?></td>
                        <td><?php echo  $product['ChiTiet']; ?></td>
                        <td><?php echo  number_format($product['DonGia'], 0, ',','.') ?><sup>đ</sup></td>
                        <td><?php echo $product['SoLuong']; ?></td>
                        <td><?php echo $product['TenLoaiSP']; ?></td>
                        <td>          
                            <a href="edit_product.php?id=<?php echo $product['MaSp']; ?>">Sửa</a>
                        </td>
                        <td>
                            <a href="delete_product.php?id=<?php echo $product['MaSp']?>">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
        <?php if ($totalPages > 1) : ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination d-flex justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
        <a class="btn btn-primary" href="quanlyshop.php">Quay Lại</a>
        <a class="btn btn-primary" href="add_product.php">Thêm Mới</a>
    </div>

</div>
<?php include 'footer.php';?>   