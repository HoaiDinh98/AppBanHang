
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
$order_data = $order->getcthd($pdo,$id);

// if(!isset($_SESSION['login_detail'])){
//     $error = ' bạn cần đăng nhặp để vào giỏ hàng';
// }

// $user = Auth::getOneByID($pdo, $id);

if (isset($_POST['delete'])) {
   
    $ProductID = $_POST['ProductID'];
    $order->deletectdh($pdo, $ProductID);
    $order_data = $order->getcthd($pdo,$id);;

}

// if (isset($_POST['update'])) {
   
//     $ProductID = $_POST['ProductID'];
//     $Amount = $_POST['Amount'];
//     $order->update($pdo,$ProductID, $id, $Amount);
//     $order_data = $order->get($pdo,$id);

// }
// if (isset($_POST['finish'])) {
//     $order = new Cart();
   
//     $order->deleteAll($pdo, $id);
//     header('location: listUser.php');
//     // $cart_data = $cart->get($pdo,$_SESSION['id']);
    
// }
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
                        <h2>Chi Tiết Đơn Hàng</h2>
                        <table class="table table-bordered">
                            <thead class="thead-dark" style="background-color:cadetblue">
                                <tr>
                                    <th>ID chi tiết</th>
                                    <th>ID đơn hàng</th>
                                    <th>ID sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số Lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>           
                                </tr>
                            </thead>
                            <tbody>
                            <?php   $sumAmout = 0; $TongTien = 0;?>
                                <?php foreach ($order_data as  $product) : ?>
                                    <?php  $thanhtien = 0; ?>
                                    <tr>
                                        <td><?php echo $product['idct']; ?></td>
                                        <td><?php echo $product['iddon']; ?></td>
                                        <td><?php echo $product['idsp']; ?></td>
                                        <td><?php echo $product['tenSp']; ?></td>
                                        <td><?php echo $product['soluong']; ?></td>
                                        <td><?php echo $product['Dongia']; ?></td>

                                        <td>          
                                        <form action="" method="post">
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <input type="hidden" name="ProductID" value=" <?php echo $product['idct'] ?>">
                                                <button name="update" class="btn btn-primary btn-sm" type="submit">Sửa</button>
                                            </div>
                                        </form>
                                        </td>
                                        <td>
                                        <form action="" method="post">
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <input type="hidden" name="ProductID" value=" <?php echo $product['idct'] ?>">
                                                <button name="delete" class="btn btn-danger btn-sm" type="submit">Xóa</button>
                                            </div>
                                        </form>
                                        </td>
                                    </tr>

                                    <?php $thanhtien = $product['Dongia'] * $product['soluong'];
                                        $TongTien += $thanhtien;
                                        $sumAmout +=$product['soluong'];
                                        ?>
                          
                                <?php endforeach; ?>
                            </tbody>
                            <?php 
                                $tongthanhtien = number_format($TongTien + 30000, 0, ',','.');
                                $_SESSION['TongThanhTien'] =   $tongthanhtien  ?>



                                <td><button type="button" name="" class="btn btn-primary" style="width: 150px; "><a href="listUser.php" style="text-decoration:none;color:white">Quay Lại</a> </button></td>
                                <td class="text-right"style="font-size: 18px;"> <?php echo  number_format( 30000, 0, ',','.'); ?><sup>đ</sup> Ship </td>
                                <td class="text-right"style="font-size: 18px;">Tổng tiền = <span style="color:red"> <?php echo $tongthanhtien   ?></span>  <sup>đ</sup></td>
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