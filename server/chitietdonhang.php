<?php
    include "connect.php";
    $json = $_POST['json'];
    $data = json_decode($json, true);

    foreach ($data as $value) {
        $iddon = $value['iddon'];
        $idsp = $value['idsp'];
        $tensp = $value['tensp'];
        $gia = $value['gia'];
        $soluong = $value['soluong'];

        $query = "INSERT INTO chitietdonhang (id,iddon,idsp,tensp,soluong,gia)
            VALUES (null, '$iddon', '$idsp', '$tensp', '$soluong', '$gia')";
        $dta = mysqli_query($conn, $query);
    }
    if ($dta) {
        echo "true";
    } else { echo "false"; }
?>