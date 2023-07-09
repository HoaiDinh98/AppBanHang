
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="https://thombrownevn.com/wp-content/uploads/2018/07/cropped-111-32x32.png" sizes="32x32">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
          rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
          rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css"
          rel="stylesheet" />
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
            <link rel="stylesheet" href="layout.css">
    <title>Dinh</title>
</head>
<style>
</style>
<body style="overflow-x:hidden">
    
    <header>
    <div style="background-color: white; width: 100%; height: 17vh;top:0; position:fixed ;z-index:999">
        <div class="container text-center" style="width:65%">
            <div class="container text-center">
                <div class="row d-flex " style="height:10vh">
                    <div class="col   d-flex justify-content-start align-items-center m-lg-2">
                        <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/09/Logo-Yame.png" style="width:60%;height:60px" />
                    </div>
                    <div class="col-7 mt-4 d-flex justify-content-end align-items-center">
                        <p>
                        <?php if(!isset($_SESSION['login_detail'])): ?>
                            <a style=" text-decoration:none; color: gray ;margin-left:20px" href="resigter.php">Đăng Ký</a>
                        <?php if(!isset($_SESSION['login_admin'])): ?>
                        <a style=" text-decoration:none; color: gray ;margin-left:20px" href="login.php">Đăng nhặp </a>
                        
                        <?php else:?>
                                <p  style=" text-decoration:none; color: red ;margin-left:20px">Bạn là: <?php echo $_SESSION['admin']?> </p>
                                <a  style=" text-decoration:none; color: gray ;margin-left:20px" href="logout.php"> Đăng Xuất </a>
                        <?php endif ?>
                    <?php else:?>
                            <p  style=" text-decoration:none; color: red ;margin-left:10px">Chào bạn: <?php echo $_SESSION['name'] ?> </p>
                            <a style=" text-decoration:none; color: gray ;margin-left:20px" href="logout.php"> Đăng Xuất </a>
                           
                    <?php endif ?>

                         
                              <a style=" text-decoration: none; color: gray; margin-left: 20px " href="cart.php">Giỏ hàng</a>
                        </p>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg ">

                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><i class="fa-solid fa-house-chimney"></i></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="product.php">STORE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">CONTACT</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="about.php">ABOUT US</a>
                            </li>
                        </ul>
                        <form action="product_search.php?" method="GET" class="d-flex">
                            <input class="form-control me-2" id="search" name="search" type="search" placeholder="Search" aria-label="Search" >
                            <button class="btn btn-outline-dark" type="submit">  Search</button>
                        </form>
                    </div>
                </div>
            </nav>

        </div>
    </div>
    </header>