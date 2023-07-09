<?php
$id = $_GET['id'];
session_start();
require '../class/Database.php';
require '../class/Auth.php';

$db = new Database();
$pdo = $db->getConnect();
$user = Auth::getOneByID3($pdo, $id);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $Phone = $_POST['Phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $role = 0;
    $user2 = Auth::edit($pdo,$id,$password,$userName,$Phone,$address,$userEmail,$role);
    if ($user2==true) {
        header("Location: listUser.php");
        exit();
    } else {
        echo "Có lỗi xảy ra khi cập nhật sản phẩm";
    }
}
?>
<?php include 'header.php'; ?>
<div class="container-fluid" style="margin-top: 25vh;">
    <div class="card">
        <div class="card-header">
            <h2>Edit user</h2>
        </div>
        <form action=""method="POST" enctype="multipart/form-data">
            
        <div class="d-flex flex-row align-items-center mb-4">
                                                                                          
                                        <div class=" flex-fill mb-0">
                                        <input type="hidden" name="id" class="form-control" value="<?php echo $user['TenTK']; ?>"/>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fa fa-user fa-lg me-3 fa-fw"></i>
                                        <div class=" flex-fill mb-0">
                                            <input type="text" name="userName" class="form-control"value="<?php echo $user['TenKH']?>"/>
                                            <label class="form-label" for="form3Example1c">Your Name</label>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fa-solid fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class=" flex-fill mb-0">
                                            <input type="email" name="userEmail" class="form-control" value="<?php echo $user['Email']; ?>"/>
                                            <label class="form-label" for="form3Example1c">Email</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fa-solid fa-phone fa-lg me-3 fa-fw"></i>
                                        <div class=" flex-fill mb-0">
                                            <input type="text" name="Phone" class="form-control" value="<?php echo $user['SDT']; ?>"/>
                                            <label class="form-label" for="form3Example1c">Phone number</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fa-solid fa-location-dot fa-lg me-3 fa-fw"></i>
                                        <div class=" flex-fill mb-0">
                                            <input type="text" name="address" class="form-control" value="<?php echo $user['DiaChi']; ?>"/>
                                            <label class="form-label" for="form3Example4c">Address</label>
                                        </div>
                                    </div>

                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fa fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class=" flex-fill mb-0">
                                            <input type="password"name="password" class="form-control" value="<?php echo $user['MK'] ; ?>" />
                                            <label class="form-label" for="form3Example1c">Password</label>
                                        </div>
                                    </div>


                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button class="btn btn-primary btn-lg" type="submit" name="submit">Sửa</button>
                                        <a href="listUser.php" class="btn btn-danger btn-lg ms-5">Quay lại</a>
                                    </div>
             </form>

                                   
    </div>
</div>
<?php include 'footer.php'; ?>


