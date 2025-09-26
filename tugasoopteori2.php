<?php
class ItemPerpustakaan {
    public $judul;
    public $tahunTerbit;
    public $statusPinjam = false;

    public function __construct($judul, $tahunTerbit) {
        $this->judul = $judul;
        $this->tahunTerbit = $tahunTerbit;
    }

    public function pinjam() {
        if ($this->statusPinjam) {
            echo "Item '{$this->judul}' sudah dipinjam.<br>";
        } else {
            $this->statusPinjam = true;
            echo "Item '{$this->judul}' berhasil dipinjam.<br>";
        }
    }
}

class Buku extends ItemPerpustakaan {
    public $isbn;

    public function __construct($judul, $tahunTerbit, $isbn) {
        parent::__construct($judul, $tahunTerbit);
        $this->isbn = $isbn;
    }

    public function pinjam() {
        echo "Buku '{$this->judul}' dengan ISBN {$this->isbn} berhasil dipinjam.<br>";
    }
}

class DVD extends ItemPerpustakaan {
    public $durasi;

    public function __construct($judul, $tahunTerbit, $durasi) {
        parent::__construct($judul, $tahunTerbit);
        $this->durasi = $durasi;
    }

    public function pinjam() {
        echo "DVD '{$this->judul}' berdurasi {$this->durasi} menit berhasil dipinjam.<br>";
    }
}

class Majalah extends ItemPerpustakaan {
    public $edisi;

    public function __construct($judul, $tahunTerbit, $edisi) {
        parent::__construct($judul, $tahunTerbit);
        $this->edisi = $edisi;
    }

    public function pinjam() {
        echo "Majalah '{$this->judul}' edisi {$this->edisi} berhasil dipinjam.<br>";
    }
}

$buku = new Buku(judul: "White Nights", tahunTerbit: 1848, isbn: "978-0-241-2508-6 <br>") ;
$buku->pinjam();

$dvd = new DVD("KPop Demon Hunters", 2025, 100) ;
$dvd->pinjam();

$majalah = new Majalah("Black Tie Affair", 2023, "Summer/Spring <br>");
$majalah->pinjam();


trait Loggable {
    public function logActivity($pesan) {
        echo "[LOG] $pesan<br>";
    }
}

trait Notifiable {
    public function sendNotification($pesan) {
        echo "[NOTIFIKASI] $pesan<br>";
    }
}

trait Searchable {
    public function search($keyword) {
        echo "Mencari data dengan kata kunci: '$keyword'<br>";
    }
}

class Pengguna {
    use Loggable, Notifiable;
    public $nama;

    public function __construct($nama) {
        $this->nama = $nama;
    }
}

class Produk {
    use Loggable, Searchable;
    public $namaProduk;

    public function __construct($namaProduk) {
        $this->namaProduk = $namaProduk;
    }
}

class Transaksi {
    use Loggable, Notifiable, Searchable;
    public $idTransaksi;

    public function __construct($idTransaksi) {
        $this->idTransaksi = $idTransaksi;
    }
}

$pengguna = new Pengguna("Khairunnisa <br>");
$pengguna->logActivity("Login berhasil. <br>");
$pengguna->sendNotification("Selamat datang, {$pengguna->nama}! <br>");

$produk = new Produk("Enola Holmes <br>");
$produk->logActivity("Produk ditambahkan ke katalog. <br>");
$produk->search("DVD");

$transaksi = new Transaksi("TRX001 <br>");
$transaksi->logActivity("Transaksi dibuat. <br>");
$transaksi->sendNotification("Pembayaran berhasil. <br>");
$transaksi->search("TRX001 <br>");

?>
