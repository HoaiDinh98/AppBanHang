<?php
session_start();
require '../class/Auth.php';
require '../class/Database.php';
$db = new Database();
$pdo = $db->getConnect();

$perPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;
$limit = $perPage;
$data = Auth::getUser($pdo, $limit, $offset);
$totalProducts = Auth::countAll($pdo);
$totalPages = ceil($totalProducts / $perPage);
?>

<?php include 'header.php'; ?>

<div class="container-fluid"style="margin-top: 25vh; width:100%">
    <h1 class="h3 mb-4 text-gray-800">Danh Sách User</h1>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark" style="background-color:cadetblue">
                <tr>
                    <th>AccountName</th>              
                    <th>UserName</th>
                    <th>userEmail</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                    <th>Xem đơn hàng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $user) : ?>
                <tr>
                    <td><?php echo $user['TenTK']; ?></td>
                    <td><?php echo $user['TenKH']; ?></td>
                    <td><?php echo $user['Email']; ?></td>
                    <td><?php echo $user['SDT']; ?></td>
                    <td><?php echo $user['DiaChi']; ?></td>
                    <td><?php echo $user['Role']; ?></td>
                    <td>
                        <a
                            href="edit_user.php?id=<?php echo $user['TenTK']?>">Sửa</a>
                    </td>
                    <td>
                        <a  href="delete_user.php?id=<?php echo $user['TenTK'] ?>">Xóa</a>
                    </td>
                    <td>
                        <a  href="donhang.php?id=<?php echo $user['TenTK'] ?>">Đơn hàng</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
        <?php if ($totalPages > 1) : ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination d-flex justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>"><a class="page-link"
                        href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
    <a class="btn btn-primary" href="quanlyshop.php">Quay Lại</a>
</div>


<?php include 'footer.php'; ?>