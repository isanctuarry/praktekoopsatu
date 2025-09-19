<?php 
class Mobil {

    public $pemilik;
    public $merk;
    public $warna;

    public function hidupkan_mobil(): string {
        return 'Hidupkan Mesin Mobil';
    }

    public function matikan_mobil(): string{
        return 'Matikan Mesin Mobil';
    }
}

$mobil1 = new Mobil();
echo $mobil1->hidupkan_mobil();