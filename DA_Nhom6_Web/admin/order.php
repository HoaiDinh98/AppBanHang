
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

if (isset($_POST['update'])) {
   
    $ProductID = $_POST['ProductID'];
    $Amount = $_POST['Amount'];
    $order->update($pdo,$ProductID, $id, $Amount);
    $order_data = $order->get($pdo,$id);

}

if (isset($_POST['finish'])) {
    $order = new Order();
   
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
                            <h1 class="h3 mb-4 text-gray-800">Thông Tin User</h1>
                            <div class="card-body">
                                <table class="table">
                                    <thead class="thead-dark" style="background-color:cadetblue">
                                        <tr>            
                                            <th>UserName</th>
                                            <th>userEmail</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Sửa Thông Tin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $user['userName']; ?></td>
                                            <td><?php echo $user['userEmail']; ?></td>
                                            <td><?php echo $user['Phone']; ?></td>
                                            <td><?php echo $user['address']; ?></td>
                                            <td><?php echo $user['city']; ?></td>
                                            <td>
                                                <a
                                                    href="edit_user.php?id=<?php echo $user['id']?>">Sửa</a>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <h2>Đơn Hàng</h2>
                        <table class="table table-bordered">
                            <tr>
                                
                                <th>ID</th>

                                <th>Hình</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                                <th></th>
                            </tr>
                            <?php   $sumAmout = 0; $TongTien = 0;?>
                            <?php foreach ($order_data as  $product) : ?>
                                <?php   
                                    $thanhtien = 0; ?>
                                <tr>
                                
                                <td> <?php echo $product['ProductID']; ?>  </td>
                                    <td class="text-center"><img src="image/<?php echo $product['ProductImage']; ?>" width="70" height="60" /> </td>
                                    <td><a target="_blank" href=""> <?php echo $product['ProductName']; ?> </td> </a> </td>


                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="ProductID" value="<?php echo $product['ProductID']; ?> </td>" />
                                            <input type="number" name="Amount"  value="<?php echo $product['Amount']; ?>" style="width:50px"  />
                                            <button type="submit"  name="update"class="btn btn-primary btn-sm"> Cập nhật </button>
                                        </form>
                                    </td>
                                    <td> <?=  number_format($product['Price'], 0, ',','.') ?><sup>đ</sup> </td>
                                    <?php $thanhtien = $product['Price'] * $product['Amount'];
                                        $TongTien += $thanhtien;
                                        $sumAmout +=$product['Amount'];
                                        ?>
                                    <td> <?php echo number_format($thanhtien, 0, ',','.')?>  <sup>đ</sup> </td>
                                   
                                    <td>  <form action="" method="post">
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <input type="hidden" name="ProductID" value=" <?php echo $product['ProductID'] ?>">
                                                <button name="delete" class="btn btn-danger btn-sm" type="submit">Xóa</button>
                                            </div>
                                        </form> </td>
                                    
                                </tr>
                                <?php endforeach; ?>
                            <tr>
                                <td></td>
                                <td class="text-right" style="font-size: 18px;">Tổng số lượng: <span style="color:red">  <?php echo $sumAmout ?></span> Sản Phẩm</td>
                                <td class="text-right" style="font-size: 18px;">Tiền Ship: <?php echo  number_format(30000, 0, ',','.') ?></span>  <sup>đ</sup></td>

                                <!-- <?php 
                                $tongthanhtien = number_format($TongTien + 30000, 0, ',','.');
                                $_SESSION['TongThanhTien'] =   $tongthanhtien  ?> -->


                                <td class="text-right"style="font-size: 18px;">Tổng thành tiền:<span style="color:red"> <?php echo $_SESSION['TongThanhTien']   ?></span>  <sup>đ</sup></td>
                                <td>  <form action="" method="post">
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <input type="hidden" name="ProductID" value=" <?php echo $product['ProductID'] ?>">
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