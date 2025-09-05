<?php 
class persegipanjang {
    //property
    public$panjang;
    public$lebar;
    
    public function_contruct ($panjang, $lebar) {
        $this->lebar = $lebar;
        $this->panjang = $panjang;
    }
    public function luas(){
        return $this-> panjang * $this->lebar;
    } 
    
    public function keliling(){
        return $this-> 2* ($this->panjang + $this ->lebar);
    
    $pp= persegipanjang(8, 5);
    echo "Luas Persegi Panjang: " . $pp->luas() ."\n";
    echo "Keliling Persegi Panjang: " . $pp->keliling() . "\n"
    } 

class product {
    public $nama;
    public $harga;
    public $stok;

    public function_contruct ($panjang, $lebar) {
        $this->nama = $nama;
        $this->harga = $harga;
        $this->stok = $stok;
    }
    public fucntion tampilkaninfo() {
        echo "Nama Produk: " . $this->nama ."\n";
        echo "Harga: " Rp . number_format($this->harga, 0, ',', '.') ."\n";
        echo "Stok: " . $this->stok . "\n"; 
    }

    public function beliproduk($jumlah) {
        if ($jumlah > $this->stok) {
            echo "Stok tidak cukup! Hanya tersedia {$this->stok}.\n";
        } else {
            $this->stok -= $jumlah;
            $total = $jumlah * $this->harga;
            echo "Berhasil membeli {$jumlah} {$this->nama}. Total: Rp " . number_format($total, 0, ',', '.') . "\n";
        }
    } 

}

$product1 = new product ("Sunscreen", 56000, 50);
$product1 ->tampilkaninfo();

echo"\n";
$product1 -> beliproduk(2);
$product1 -> tampilkaninfo();
?>



    
    