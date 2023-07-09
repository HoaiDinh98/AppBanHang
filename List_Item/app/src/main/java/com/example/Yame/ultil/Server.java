package com.example.Yame.ultil;

import com.example.Yame.Model.User;

public class Server {
    public static String localhost = "169.254.153.1:8080";
    public static String linkProduct = "http://" + localhost + "/server/product.php";
    public static String linkProductNew = "http://" + localhost + "/server/productNew.php";
    public static String linkProductandCat = "http://" + localhost + "/server/productandCat.php";
    public static String linkproductShort = "http://" + localhost + "/server/productShort.php";
    public static String linkProductTee = "http://" + localhost + "/server/productTee.php";
    public static String linkProductShirt = "http://" + localhost + "/server/productShirt.php";
    public static String linkProductPant = "http://" + localhost + "/server/productPant.php";
    public static String linkLogin = "http://" + localhost + "/server/dangNhap.php";
    public static String linkRegister = "http://" + localhost + "/server/dangKi.php";
    public static String linkUser = "http://" + localhost + "/server/user.php";
    public static String linkOrder = "http://" + localhost + "/server/donhang.php";
    public static String linkOrderDetails = "http://" + localhost + "/server/chitietdonhang.php";
    public static String linkSearch = "http://" + localhost + "/server/search.php";
    public  static User user_current;

}
