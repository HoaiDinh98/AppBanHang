<?php
class SanPham{
    public $MaSp;
    public $TenSP;
    public $HinhAnh;
    public $DonGia;
    public $ChiTiet;

        function __construct($MaSp,$TenSP,$HinhAnh,$DonGia,$ChiTiet){
            $this->MaSp = $MaSp;
            $this->TenSP = $TenSP;
            $this->HinhAnh = $HinhAnh;
            $this->DonGia = $DonGia;
            $this->ChiTiet = $ChiTiet;
        }
        function SanPham($MaSp,$TenSP,$HinhAnh,$DonGia){
            $this->MaSp = $MaSp;
            $this->TenSP = $TenSP;
            $this->HinhAnh = $HinhAnh;
            $this->DonGia = $DonGia;
        }
    }

?>