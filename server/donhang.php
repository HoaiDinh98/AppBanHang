<?php
    include "connect.php";
    
    $iduser = $_POST['iduser'];
    $diachi = $_POST['diachi'];
    $sdt = $_POST['sdt'];
    
    if(strlen($iduser) > 0 && strlen($diachi) > 0 && strlen($sdt) > 0) {
        $query = "INSERT INTO donhang(id, iduser, sdt, diachi) VALUES (null, '$iduser', '$sdt', '$diachi')";
        if(mysqli_query($conn, $query)) {
            $iddon = $conn->insert_id;
            echo $iddon;
        } else {
            echo "Thất bại";
        }
    } else {
        echo "Hãy kiểm tra lại dữ liệu";
    }
?>