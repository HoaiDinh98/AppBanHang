<?php
require 'init.php';
require 'class/Auth.php';
require 'class/Database.php';
$db = new Database();

$pdo = $db->getConnect();
$error='';

if($_SERVER["REQUEST_METHOD"]  == "POST"){
    $Account = $_POST['Account'];
    $password = $_POST['password'];
    $error  = Auth::login($pdo,$Account,$password);

}


?>
<?php  include 'header.php'?>
    <main class="bg">
    <div class="container"style="margin-top:30vh">       
                <div class=" p-4 text-center">
                        <div class="col-4">
                            <h1>Đăng Nhặp</h1>
                            <div class="background p-3">
                            <form method="post" class="form-control">
                                <div class="form-filde mb-4">
                                    <label for="Account" class="form-label">Account</label>
                                    <input type="text" class="form-control" id="Account" name = "Account" required>
                                </div>
                                <div class="form-filde mb-4">
                                 <label for="password" class="form-label">password</label>
                                    <input type="password" class="form-control" id="password" name = "password" required>
                                </div>
                                <button type="submit" class="btn w-100 mb-4" name="login" value="submit">Sign in</button>                            
                            </form>
                            <?php if($error): ?>
                                <div> 
                                    <p class="text-danger"><?=$error ?></p>
                                </div>
                             <?php endif; ?>
                        </div>
                     
                    </div>                 
                </div>        
    </div>
</main>

<?php  include 'footer.php'?>


