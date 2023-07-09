<?php
session_start();
require '../class/Database.php';
require '../class/Auth.php';


$db = new Database();
    $pdo = $db->getConnect();
     $id = isset($_GET['id']) ? $_GET['id'] : null;
     if (!$id) {
         die("id không hợp lệ.");
     }
  
     $user = Auth::getOneByID3($pdo, $id);
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = Auth::delete($pdo, $id); ;
            header("Location: listUser.php");

    }



?>
<?php include 'header.php'; ?>


<div class="container-fluid"style="margin-top: 25vh;">
    <h1 class="h3 mb-4 text-gray-800">Xóa Tài Khoản</h1>
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
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $user['TenTK']; ?></td>
                    <td><?php echo $user['TenKH']; ?></td>
                    <td><?php echo $user['Email']; ?></td>
                    <td><?php echo $user['SDT']; ?></td>
                    <td><?php echo $user['DiaChi']; ?></td>
                    <td><?php echo $user['Role']; ?></td>
                </tr>
            </tbody>

        </table>
        <form method="post" class="m-auto">
            <p>Bạn có chắc chắn muốn xóa?</p>
            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="listUser.php" class="ntn btn-primary">Cancel</a>
        </form>
    </div>

</div>



<?php include 'footer.php'; ?>