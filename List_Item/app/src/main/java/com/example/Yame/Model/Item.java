package com.example.Yame.Model;

import java.io.Serializable;

public class Item implements Serializable {
    private int id;
    private String name;
    private String img;
    private int price;
    private int size;
    private String detail;

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getDetail() {
        return detail;
    }

    public void setDetail(String detail) {
        this.detail = detail;
    }

    public Item(int id, String name, String img, int price, String detail) {
        this.id = id;
        this.name = name;
        this.img = img;
        this.price = price;
        this.detail = detail;
    }

//    public Item(String name, String img, int price, String detail) {
//        this.name = name;
//        this.img = img;
//        this.price = price;
//        this.detail = detail;
//    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getImg() {
        return img;
    }

    public void setImg(String img) {
        this.img = img;
    }

    public int getPrice() {
        return price;
    }

    public void setPrice(int price) {
        this.price = price;
    }

    public int getSize() {
        return size;
    }

    public void setSize(int size) {
        this.size = size;
    }

}
