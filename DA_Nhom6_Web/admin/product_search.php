<?php
 session_start();

 require '../class/Product.php';
 require '../class/Database.php';
 $db = new Database();
 $pdo = $db->getConnect();
//  $data = Product::getAll($pdo);



$perPage = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;
$limit = $perPage;

$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
if ($sort === 'asc') {
    $data = Product::getByPriceAsc($pdo, $limit, $offset);
} elseif ($sort === 'desc') {
    $data = Product::getByPriceDesc($pdo, $limit, $offset);
} else {
    $search = isset($_GET['search']) ? $_GET['search'] : null;

    if ($search !== '') {
        $data = Product::searchProducts($pdo, $search, $limit, $offset);
    } else {
        $data = Product::getPage($pdo, $limit, $offset);
    }
}


$totalProducts = Product::countAll($pdo);
$totalPages = ceil($totalProducts / $perPage);
?>

<?php  include 'header.php'?>

<div class="container text-center " style="margin-top:25vh">
    <p style="margin-top: 30px; margin-bottom: -10px; font-size: 25px; font-weight: 600">
        SẢN PHẨM
    </p>
    <nav class="navbar navbar-expand-lg navbar-light"style=" border-bottom: 1px solid gray">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Lọc giá
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?sort=asc">Giá tăng dần</a></li>
                            <li><a class="dropdown-item" href="?sort=desc">Giá giảm dần</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Loại
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="">Áo Thun</a></li>
                            <li><a class="dropdown-item" href="">Áo Khoác</a></li>
                            <li><a class="dropdown-item" href="">Quần Short</a></li>
                            <li><a class="dropdown-item" href="">Quần Jean</a></li>
                            <li><a class="dropdown-item" href="">Áo Kiểu Nữ</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Màu Sắc
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="">BLACK</a></li>
                            <li><a class="dropdown-item" href="">WHITE</a></li>
                            <li><a class="dropdown-item" href="">BLUE</a></li>
                            <li><a class="dropdown-item" href="">GREEN</a></li>
                            <li><a class="dropdown-item" href="">BROWN</a></li>
                            <li><a class="dropdown-item" href="Y">GREY</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container text-center mt-4">
        <div class="row row-cols-4 " style="margin-left:30px">
            <?php foreach($data as  $product ):?>    
                    <div class="col" style=" margin-top:20px">  
                        <a href="detail.php?id=<?=$product['ProductID']?>" style="font-size: 12px; text-decoration: none; color:gray">
                            <div class="card-group">
                                <div class="card" style="width: 13rem; border: none; text-decoration: none; z-index: -100">

                                    <img src="image/<?=$product['ProductImage'] ?>" class="card-img-top img-fluid hover-shadow" alt="..." style="width: 100%;height:30vh">

                                    <div class="card-body" style=" z-index: 100;height:20vh">
                                        <p class="card-text" style="font-size: 15px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;; "><?= $product['ProductName']?></p>
                                        <p class="card-text" style="font-size: 18px;"><?=  number_format($product['Price'], 0, ',','.') ?><sup>đ</sup></p>
                                    </div>
                                </div>
                            </div>
                        </a>                    
                    </div>  
                
                    <?php endforeach ;?>               
        </div>

    </div>
    <div colspan="9">
        <div class="pagination justify-content-center " style="margin-left:10vh; margin-top:8vh">
                <?php if ($totalPages > 1) : ?>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination d-flex justify-content-center">
                            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
        </div>
    </div>

  
</div>

<?php  include 'footer.php'?>