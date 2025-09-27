<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Poppins:wght@300;500&display=swap" rel="stylesheet">
    <title>Latihan Abstraksi & Polimorfisme</title>
    <style>
        body {
            font-family: Poppins;
            background: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #c0fee3ff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .container h2 {
            margin-top: 0;
            color: #4a8169ff;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }
        .output {
            background: #c0fee3ff;
            border: 1px solid #ddd;
            padding: 15px;
            margin-top: 10px;
            border-radius: 5px;
            font-family: Poppins;
            color: #444;
        }
    </style>
</head>
<body>

<?php
// Abstraksi
ob_start();

abstract class Kendaraan {
    abstract public function jalan();
}

class Mobil extends Kendaraan {
    public function jalan() {
        echo "Mobil Porsche Taycan berjalan dengan 4 roda <br>";
    }
}

class Motor extends Kendaraan {
    public function jalan() {
        echo "Motor Yamaha YZF-R1 berjalan dengan 2 roda <br>";
    }
}

$motor1 = new Motor();
$motor1->jalan();
$mobil1 = new Mobil();
$mobil1->jalan();

$abstraksiOutput = ob_get_clean();


//Polimorfisme (Bangun Datar)
ob_start();

interface BangunDatar {
    public function luas();
    public function namaBD();
    public function infoBD();
}

class Persegi implements BangunDatar {
    private $sisi;
    public function __construct($sisi) {
        $this->sisi = $sisi;
    }
    public function luas() {
        return $this->sisi * $this->sisi;
    }
    public function namaBD() {
        return "Persegi";
    }
    public function infoBD() {
        return "Sisi = " . $this->sisi;
    }
}

class Lingkaran implements BangunDatar {
    private $jari2;
    public function __construct($jari2) {
        $this->jari2 = $jari2;
    }
    public function luas() {
        return pi() * $this->jari2 * $this->jari2;
    }
    public function namaBD() {
        return "Lingkaran";
    }
    public function infoBD() {
        return "Jari-jari = " . $this->jari2;
    }
}

$bangunDatar = [
    new Persegi(6),
    new Lingkaran(8)
];

foreach ($bangunDatar as $BD) {
    echo $BD->namaBD() . " (" . $BD->infoBD() . ") → Luas = " 
        . number_format($BD->luas(), 2) . "<br>";
}

$polimorfismeOutput = ob_get_clean();


// Abstraksi & Polimorfisme (Perpustakaan)
ob_start();

abstract class ItemPerpustakaan {
    protected $judul;
    public function __construct($judul) {
        $this->judul = $judul;
    }
    abstract public function pinjam();
}

class Buku extends ItemPerpustakaan {
    public function pinjam() {
        echo "Buku \"{$this->judul}\" berhasil dipinjam.<br>";
    }
}

class Majalah extends ItemPerpustakaan {
    public function pinjam() {
        echo "Majalah \"{$this->judul}\" berhasil dipinjam.<br>";
    }
}

$items = [
    new Buku("White Nights"),
    new Majalah("GQ Winter Collection"),
    new Buku("Bittersweet"),
    new Majalah("Halloween Outfit")
];

foreach ($items as $item) {
    $item->pinjam();
}

$perpustakaanOutput = ob_get_clean();
?>

<!-- Container Abstraksi -->
<div class="container">
    <h2>Abstraksi (Kendaraan)</h2>
    <div class="output">
        <?= $abstraksiOutput; ?>
    </div>
</div>

<!-- Container Polimorfisme -->
<div class="container">
    <h2>Polimorfisme (Bangun Datar)</h2>
    <div class="output">
        <?= $polimorfismeOutput; ?>
    </div>
</div>

<!-- Container Abstraksi & Polimorfisme -->
<div class="container">
    <h2>Abstraksi & Polimorfisme (Perpustakaan)</h2>
    <div class="output">
        <?= $perpustakaanOutput; ?>
    </div>
</div>

</body>
</html>
