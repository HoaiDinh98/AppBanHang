<?php
session_start();
require '../class/Product.php';
require '../class/Database.php';
$db = new Database();
$pdo = $db->getConnect();

$perPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;
$limit = $perPage;
$data = Product::getPage2($pdo, $limit, $offset);
$totalProducts = Product::countAllCat($pdo);
$totalPages = ceil($totalProducts / $perPage);
?>

<?php include 'header.php' ;?>   

<div class="container-fluid" style="margin-top: 25vh;">
    <h1 class="h3 mb-4 text-gray-800">Danh Sách Loại Sản Phẩm</h1>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark" style="background-color:cadetblue">
                <tr>
                    <th>ID</th>
                    <th>TÊn Loại sản phẩm</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as  $product) : ?>
                    <tr>
                        <td><?php echo $product['MaLoaiSP']; ?></td>
                      
                        <td><?php echo  $product['TenLoaiSP']; ?></td>
                      
                    
                        <td>          
                            <a href="edit_product.php?id=<?php echo $product['MaLoaiSP']; ?>">Sửa</a>
                        </td>
                        <td>
                            <a href="delete_product.php?id=<?php echo $product['MaLoaiSP']?>">Xóa</a>
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