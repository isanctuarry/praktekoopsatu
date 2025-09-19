<?php

class Akun
{
    var $username;
    var $password;
    var $email;

}

$akun_tesa = new Akun();
$akun_wawa = new Akun();

$akun_tesa->username = "TesaFirnaAnanta";
$akun_tesa->password = "12345";
$akun_tesa->email = "Tesafirna@gmail.com";

$akun_wawa->username = "ShalwaNafiisaYusri";
$akun_wawa->password = "54321";
$akun_wawa->email = "shalwanafiisa@gmail.com";

echo $akun_tesa->username;
echo "\n";
echo $akun_tesa->password;
echo "\n";
echo $akun_tesa->email;
echo "\n";
echo "\n";
echo $akun_wawa->username;
echo "\n";
echo $akun_wawa->password;
echo "\n";
echo $akun_wawa->email;
echo "\n";