<?php
class Bunga {
    public $nama;

    // Constructor → otomatis dijalankan saat objek dibuat
    public function __construct($namaBunga) {
        $this->nama = $namaBunga;
        echo "Bunga {$this->nama} telah mekar.<br>";
    }

    // Destructor → otomatis dijalankan saat objek dihapus / program selesai
    public function __destruct() {
        echo "Bunga {$this->nama} dihancurkan.<br>";
    }

    public function tampilkan() {
        echo "Ini adalah bunga: {$this->nama}.<br>";
    }
}

// Membuat objek
$bunga1 = new Bunga("Bluebell");
$bunga1->tampilkan();

$bunga2 = new Bunga("Lavender");
$bunga2->tampilkan();
?>