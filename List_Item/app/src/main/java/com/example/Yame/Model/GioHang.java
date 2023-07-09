package com.example.Yame.Model;

public class GioHang {
    int idSP;
    int soLuong;
    int donGia;

    int size;
    String tenSP, anhSP;

    public GioHang() {
    }

    public GioHang(int idSP, String tenSP, int donGia, String anhSP, int soLuong, int size) {
        this.idSP = idSP;
        this.soLuong = soLuong;
        this.tenSP = tenSP;
        this.anhSP = anhSP;
        this.donGia = donGia;
        this.size = size;
    }

    public int getIdSP() {
        return idSP;
    }

    public void setIdSP(int idSP) {
        this.idSP = idSP;
    }

    public int getSoLuong() {
        return soLuong;
    }

    public void setSoLuong(int soLuong) {
        this.soLuong = soLuong;
    }

    public String getTenSP() {
        return tenSP;
    }

    public void setTenSP(String tenSP) {
        this.tenSP = tenSP;
    }

    public String getAnhSP() {
        return anhSP;
    }

    public void setAnhSP(String anhSP) {
        this.anhSP = anhSP;
    }

    public int getDonGia() {
        return donGia;
    }

    public void setDonGia(int donGia) {
        this.donGia = donGia;
    }

    public int getSize() {
        return size;
    }

    public void setSize(int size) {
        this.size = size;
    }

}

