<?php
class User{
    public $tk;
    public $mk;
    public $hoTen;
    public $diaChi;
    public $sdt;
    public $email;

        function __construct($tk, $mk, $hoTen, $diaChi, $sdt, $email){
            $this->tk = $tk;
            $this->mk = $mk;
            $this->hoTen = $hoTen;
            $this->diaChi = $diaChi;
            $this->sdt = $sdt;
            $this->email = $email;
        }
        function User($tk, $mk, $hoTen, $diaChi, $sdt, $email){
            $this->tk = $tk;
            $this->mk = $mk;
            $this->hoTen = $hoTen;
            $this->diaChi = $diaChi;
            $this->sdt = $sdt;
            $this->email = $email;
        }
    }

?>