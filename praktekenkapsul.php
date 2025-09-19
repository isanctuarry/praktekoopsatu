<?php
//public
// buat class mobil
class mobil
{
  // buat protected property
  protected $pemilik = "yuda";
  public function akses_pemilik()
  {
    return $this->pemilik;
  }
  protected function hidupkan_mobil()
  {
    return "Hidupkan Mobil";
  }
  public function paksa_hidup()
  {
    return $this->hidupkan_mobil();
  }
}
// buat objek dari class mobil (instansiasi)
$mobil_yuda = new mobil();
// jalankan method akses_pemilik()
echo $mobil_yuda->akses_pemilik(); // "yuda"
echo "\n";
// jalankan method paksa_hidup()
echo $mobil_yuda->paksa_hidup(); // "Hidupkan Mobil"
echo "\n";



//Protected
//Buat class motor
class motor
{
  //property dengan hak akses protected
  protected $jenis_mesin = "Yamaha CB JKT 48";
}
//buat class yamaha
class yamaha extends motor //class yamaha menggunakan class motor
{
  public function tampilkan_jenismesin()
  {
    return $this->jenis_mesin;
  }
}
//buat objek dari class yamaha (instantiation)
$yamaha_yuda = new yamaha();
//jalankan method
echo $yamaha_yuda->tampilkan_jenismesin(); //“Yamaha CB JKT 48”



//Private
//buat class kendaraan
class kendaraan
{
  // property dengan hak akses private
  public $jenis_mesin = "AKA 748 TURBO JET NUKLIR";
  public function tampilkan_mesin()
  {
    return $this->jenis_mesin;
  }
}
//buat class motor
class motor extends kendaraan
{
  public function tampilkan_mesin()
  {
    return $this->jenis_mesin;
  }
}
// buat objek dari class motor (instantiation)
$kendaraan_motor = new kendaraan();
$motor_honda = new motor();
//jalankan method dari class kendaraan
echo $kendaraan_motor->tampilkan_mesin(); //AKA 748 TURBO
// JET NUKLIR
//jalankan method dari class motor (error)
echo $motor_honda->tampilkan_mesin();
//notice:Undefined property: motor::$jenis_mesin
