<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Log Sistem</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f9;
      padding: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 0 auto;
      background: #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    th, td {
      border: 1px solid #ddd;
      padding: 12px 15px;
      text-align: left;
    }

    th {
      background-color: #2c3e50;
      color: #fff;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    caption {
      margin-bottom: 10px;
      font-weight: bold;
      font-size: 1.2em;
    }
  </style>
</head>
<body>

<table>
  <caption>Log Aktivitas</caption>
  <thead>
    <tr>
      <th>No</th>
      <th>Pesan</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Buku 'White Nights' dengan ISBN 978-0-241-2508-6 berhasil dipinjam.</td>
    </tr>
    <tr>
      <td>2</td>
      <td>DVD 'KPop Demon Hunters' berdurasi 100 menit berhasil dipinjam.</td>
    </tr>
    <tr>
      <td>3</td>
      <td>Majalah 'Black Tie Affair' edisi Summer/Spring berhasil dipinjam.</td>
    </tr>
    <tr>
      <td>4</td>
      <td>[LOG] Login berhasil.</td>
    </tr>
    <tr>
      <td>5</td>
      <td>[NOTIFIKASI] Selamat datang, Khairunnisa!</td>
    </tr>
    <tr>
      <td>6</td>
      <td>[LOG] Produk ditambahkan ke katalog.</td>
    </tr>
    <tr>
      <td>7</td>
      <td>Mencari data dengan kata kunci: 'DVD'</td>
    </tr>
    <tr>
      <td>8</td>
      <td>[LOG] Transaksi dibuat.</td>
    </tr>
    <tr>
      <td>9</td>
      <td>[NOTIFIKASI] Pembayaran berhasil.</td>
    </tr>
    <tr>
      <td>10</td>
      <td>Mencari data dengan kata kunci: 'TRX001'</td>
    </tr>
  </tbody>
</table>
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

$dvd = new DVD("KPop Demon Hunters", 2025, 100);
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
</body>
</html>
