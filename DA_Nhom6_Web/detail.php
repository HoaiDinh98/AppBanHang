<?php
 require 'init.php';
?>

<?php 

    require 'class/Database.php';
    require 'class/Product.php';
    require 'class/Cart.php';
    require 'class/Order.php';
    $db = new Database();
    $pdo = $db->getConnect();
     // Lấy thông tin sản phẩm từ URL
     $id = isset($_GET['id']) ? $_GET['id'] : null;
     if (!$id) {
         die("id không hợp lệ.");
     }
     $product = Product::getOneByID3($pdo, $id);
     
      if($_SERVER["REQUEST_METHOD"]  == "POST"){
        $cart = new Cart();
        // $order = new Order();
        $Amount = $_POST['Amount'];      
        $cart->add($pdo,$id,$_SESSION['id'], $Amount);
        // $order->add($pdo,$id,$_SESSION['id'], $Amount);
        header('location: cart.php');

    }
?> 




<?php  include 'header.php'?>



<div id="about" class="shop" style="margin-top:30vh">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6" style="margin-left: 5vh;">
                    <figure><img style="height: 500px;margin-left: 20vh;" src="<?=$product['HinhAnh'] ?>" alt="#"></figure>
            </div>
            
            <div class="col-md-5">
                        <h2 style="color: black"><?php echo $product['TenSP']?></h2>
                        <p> <?php echo $product['ChiTiet']?></p>
                        <div>
                            <h3 style="color: black"><span class="blu"></span><?=  number_format($product['DonGia'], 0, ',','.') ?><sup>đ</sup></h3>
                        </div>
                        <form action="" method="post">
                            <input type="hidden" name="productID" id="productID" value="<?=$product['MaSp'] ?>" />
                            <h5>Size</h5>
                            <div class="form-outline" style="width:200px">
                                <select class="form-select"
                                        id="SizeID"
                                        name="SizeID">
                                                                       
                                    <option value="<?=$product['MaSize']='S' ?>">S</option>                                  
                                    <option value="<?=$product['MaSize']='M' ?>">M</option>
                                    <option value="<?=$product['MaSize']='L' ?>">L</option>
                                    <option value="<?=$product['MaSize']='XL' ?>">XL</option>

                                    
                                </select>
                            </div>
                            <h5>Số lượng</h5>
                            <input type="number" name="Amount"style="width:50px" min="0" max="<?=$product['SoLuong'] ?>" id ="Amount" value="1" /> <br>
                            <button type="submit" name="submit"  class="btn btn-white" style="width: 300px; border: 1px solid black;margin-top:2vh"><a style="text-decoration:none;color:black"><i class="fa-solid fa-cart-shopping"></i>Thêm vào Giỏ</a> </button>
                        </form>                    
                        <div>
                           
                            

                        </div>
                    </div>
                </div>
    </div>
</div>

<?php  include 'footer.php'?>