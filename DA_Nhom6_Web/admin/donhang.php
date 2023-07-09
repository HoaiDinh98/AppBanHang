
<?php
$id = $_GET['id'];


session_start();

require '../class/Database.php';
require '../class/Product.php';
require '../class/Cart.php';
require '../class/Auth.php';
require '../class/Order.php';
$db = new Database();
$pdo = $db->getConnect();
$error = '';


$order = new Cart();
$order_data = $order->get($pdo,$id);

// if(!isset($_SESSION['login_detail'])){
//     $error = ' bạn cần đăng nhặp để vào giỏ hàng';
// }

$user = Auth::getOneByID($pdo, $id);

if (isset($_POST['delete'])) {
   
    $ProductID = $_POST['ProductID'];
    $order->delete($pdo,$ProductID, $id);
    $order_data = $order->get($pdo,$id);;

}

// if (isset($_POST['update'])) {
   
//     $ProductID = $_POST['ProductID'];
//     $Amount = $_POST['Amount'];
//     $order->update($pdo,$ProductID, $id, $Amount);
//     $order_data = $order->get($pdo,$id);

// }

if (isset($_POST['finish'])) {
    $order = new Cart();
   
    $order->deleteAll($pdo, $id);
    header('location: listUser.php');
    // $cart_data = $cart->get($pdo,$_SESSION['id']);
    
}
?>



<?php  include 'header.php'?>

    <?php if( !empty($order_data)  ): ?>
<div style="margin-top:30vh">
    
    <div class="mt-5"></div>
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                    <div class="container-fluid" style="margin-bottom: 10vh;">                         
                        </div>
                        <h2>Đơn Hàng</h2>
                        <table class="table table-bordered">
                            <thead class="thead-dark" style="background-color:cadetblue">
                                <tr>
                                    <th>ID đơn hàng</th>
                                    <th>Tên Tài Khoản</th>
                                    <th>Số điện thoại</th>
                                    <th>địa chỉ</th>   
                                    <th>Chi Tiết Đơn</th>  
                                    <th>Sửa</th>
                                    <th>Xóa</th>           
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order_data as  $product) : ?>
                                    <tr>
                                        <td><?php echo $product['id']; ?></td>
                                        <td><?php echo  $product['TENTK']; ?></td>
                                        <td><?php echo  $product['sdt']; ?></td>
                                        <td><?php echo $product['diachi']; ?></td>
                                        <td>  
                                        <a
                                            href="chitietdonhang.php?id=<?php echo $product['id']?>">Chi Tiết</a>           
                                        </td>
                                        <td>          
                                        <form action="" method="post">
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <input type="hidden" name="ProductID" value=" <?php echo $product['id'] ?>">
                                                <button name="update" class="btn btn-primary btn-sm" type="submit">Sửa</button>
                                            </div>
                                        </form>
                                        </td>
                                        <td>
                                        <form action="" method="post">
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <input type="hidden" name="ProductID" value=" <?php echo $product['id'] ?>">
                                                <button name="delete" class="btn btn-danger btn-sm" type="submit">Xóa</button>
                                            </div>
                                        </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                                <td>  <form action="" method="post">
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <input type="hidden" name="ProductID" value=" <?php echo $product['id'] ?>">
                                                <button type="submit" name="finish" class="btn btn-primary" style="width: 200px; "><a href="" style="text-decoration:none;color:white">Xóa Toàn Bộ đơn hàng</a> </button></td>
                                            </div>
                                        </form> </td>
                                <td><button type="button" name="" class="btn btn-primary" style="width: 150px; "><a href="listUser.php" style="text-decoration:none;color:white">Quay Lại</a> </button></td>
                            </tr>
                        </table>
                      
                      
                    </div>
                </div>

            </div>

        </div>
</div>
<?php else: ?>
    <h2 style="margin-top: 30vh;"> không có sản phẩm trong giỏ hàng</h2>
    <button type="button" name="" class="btn btn-primary" style="width: 150px; "><a href="listUser.php" style="text-decoration:none;color:white">Quay Lại</a> </button>
    <?php endif; ?>


<?php  include 'footer.php'?>