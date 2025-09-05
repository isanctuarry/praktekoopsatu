<?php

class product {
    private $nama;
    private $harga;
    private $stok;

    public function __construct ($nama, $harga, $stok) {
        $this->nama = $nama;
        $this->harga = $harga;
        $this->stok = $stok;
    }

    public function tampilkaninfo() {
        echo "Nama Produk: " . $this->nama ."\n";
        echo "Harga: Rp "  . number_format($this->harga, 0, ',', '.') ."\n";
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



    
    