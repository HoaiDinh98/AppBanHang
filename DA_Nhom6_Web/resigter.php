<?php 
require 'init.php';
require 'class/Auth.php';
require 'class/Database.php';
$db = new Database();

$pdo = $db->getConnect();
$error = '';
$errorsEmail='';
$errorsUsername='';
$errorsPhone='';
$errorsaddress='';
$errorspassword='';
$errorsAccountName='';

// $stmt = $pdo->prepare( 'SELECT COUNT(*) FROM taikhoan WHERE TenTK = :TenTk' );
// $stmt->bindParam(':TenTk',$AccountName,PDO::PARAM_STR);
// $stmt->execute( [ $AccountName ] );
// $count = $stmt->fetchColumn();
// if($count >0)
//     {
//         $error = 'tài khoản đã tồn tại';
//     }    
// elseif ( $count != 0 ) {
    // $password2 = '12345';
    // $sql = "INSERT INTO taikhoan (TenTK,MK,TenKH,Email,Role) VALUES ('admin',:password2 ,'admin đẹp trai','lehoaidinh@gmail.com','1')";
    // $stmt = $pdo->prepare($sql);
    // $stmt->bindParam(':password2',$password2,PDO::PARAM_STR);
    // $stmt->execute();
// }

if($_SERVER["REQUEST_METHOD"]  == "POST"){
    $AccountName = $_POST['AccountName'];
    $password = $_POST['password'];
    $username = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $Phone = $_POST['Phone'];
    $address = $_POST['address'];




   // Validate the form data
   if (empty($userEmail)) {
        $errorsEmail = 'Email is required';
    } elseif (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $errorsEmail = 'Invalid email format';
    }
    
    if (empty($username)) {
        $errorsUsername = 'Username is required';
    }
    if (empty($Phone)) {
        $errorsPhone = 'Phone is required';
    }
    if (empty($address)) {
        $errorsaddress = 'address is required';
    }
    if (empty($AccountName)) {
        $errorsAccountName = 'AccountName is required';
    }
    if (empty($password)) {
        $errorspassword = 'Password is required';
    }
    
    if(!$errorsEmail && !$errorsUsername && !$errorsPhone  && !$errorsaddress && !$errorspassword && !$errorsAccountName )
    {
    $role = 0;

    $auth = new Auth();
    $auth->AccountName=$AccountName;
    $auth->username = $username;
    $auth->userEmail = $userEmail;
    $auth->Phone = $Phone;
    $auth->address = $address;
    $auth->password = $password;
    $auth->role = $role;

    
    if (Auth::registerAccount($pdo,$AccountName,$password,$username,$Phone,$address,$userEmail,$role)) {
        header('Location: login.php');
        exit();
      } else {
        $error = 'Register failed.';
      }
    }

    
}


?>
<?php  include 'header.php'?>
<section class="vh-200" style="background-color: #eee;margin-top:30vh">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Register</p>
                                <div class="d-flex flex-row align-items-center mb-4">

                                </div>
                                <form action=""method="POST">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fa fa-user fa-lg me-3 fa-fw"></i>
                                        <div class=" flex-fill mb-0">
                                            <input type="text" name="userName" class="form-control" />
                                            <label class="form-label" for="form3Example1c">Your Name</label>
                                            <span class="text-danger" style="color:red"><?= $errorsUsername?></span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fa-solid fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class=" flex-fill mb-0">
                                            <input type="email" name="userEmail" class="form-control" />
                                            <label class="form-label" for="form3Example1c">Email</label>
                                            <span class="text-danger" style="color:red"><?= $errorsEmail?></span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fa-solid fa-phone fa-lg me-3 fa-fw"></i>
                                        <div class=" flex-fill mb-0">
                                            <input type="text" name="Phone" class="form-control" />
                                            <label class="form-label" for="form3Example1c">Phone number</label>
                                            <span class="text-danger" style="color:red"><?= $errorsPhone?></span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fa-solid fa-location-dot fa-lg me-3 fa-fw"></i>
                                        <div class=" flex-fill mb-0">
                                            <input type="text" name="address" class="form-control" />
                                            <label class="form-label" for="form3Example4c">Address</label>
                                            <span class="text-danger" style="color:red"><?= $errorsaddress?></span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4 d-inline">
                                        <i class="fa-solid fa-city fa-lg me-3 fa-fw"></i>
                                        <div class=" flex-fill mb-0">
                                            <input type="text" name="AccountName" class="form-control" />
                                            <label class="form-label" for="form3Example4c">AccountName</label>
                                            <span class="text-danger" style="color:red"><?= $errorsAccountName?></span>
                                        </div>

                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fa fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class=" flex-fill mb-0">
                                            <input type="password"name="password" class="form-control" />
                                            <label class="form-label" for="form3Example1c">Password</label>
                                            <span class="text-danger" style="color:red"><?= $errorspassword?></span>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button class="btn btn-primary btn-lg" type="submit" name="submit">Register</button>
                                        <a href="index.php" class="btn btn-danger btn-lg ms-5">Return</a>
                                    </div>
                                    <?php if($error): ?>
                                        <div> 
                                            <p class="text-danger"><?=$error ?></p>
                                        </div>
                                    <?php endif; ?>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php  include 'footer.php'?>