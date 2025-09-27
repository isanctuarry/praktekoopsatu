<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Log Aktivitas</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f9;
      padding: 20px;
    }
    table {
      width: 60%;
      border-collapse: collapse;
      margin: 0 auto;
      background: #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: left;
    }
    th {
      background: #6a5acd;
      color: #fff;
      text-align: center;
    }
    tr:nth-child(even) {
      background: #f9f9f9;
    }
    tr:hover {
      background: #f1eaff;
    }
    caption {
      font-size: 1.2em;
      font-weight: bold;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

<table>
  <caption>Log Aktivitas</caption>
  <thead>
    <tr>
      <th>Pesan</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // --- kode PHP kamu ---
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
                return "Item '{$this->judul}' sudah dipinjam.";
            } else {
                $this->statusPinjam = true;
                return "Item '{$this->judul}' berhasil dipinjam.";
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
            return "Buku '{$this->judul}' dengan ISBN {$this->isbn} berhasil dipinjam.";
        }
    }

    class DVD extends ItemPerpustakaan {
        public $durasi;

        public function __construct($judul, $tahunTerbit, $durasi) {
            parent::__construct($judul, $tahunTerbit);
            $this->durasi = $durasi;
        }

        public function pinjam() {
            return "DVD '{$this->judul}' berdurasi {$this->durasi} menit berhasil dipinjam.";
        }
    }

    class Majalah extends ItemPerpustakaan {
        public $edisi;

        public function __construct($judul, $tahunTerbit, $edisi) {
            parent::__construct($judul, $tahunTerbit);
            $this->edisi = $edisi;
        }

        public function pinjam() {
            return "Majalah '{$this->judul}' edisi {$this->edisi} berhasil dipinjam.";
        }
    }

    trait Loggable {
        public function logActivity($pesan) {
            return "[LOG] $pesan";
        }
    }

    trait Notifiable {
        public function sendNotification($pesan) {
            return "[NOTIFIKASI] $pesan";
        }
    }

    trait Searchable {
        public function search($keyword) {
            return "Mencari data dengan kata kunci: '$keyword'";
        }
    }

    class Pengguna {
        use Loggable, Notifiable;
        public $nama;
        public function __construct($nama) { $this->nama = $nama; }
    }

    class Produk {
        use Loggable, Searchable;
        public $namaProduk;
        public function __construct($namaProduk) { $this->namaProduk = $namaProduk; }
    }

    class Transaksi {
        use Loggable, Notifiable, Searchable;
        public $idTransaksi;
        public function __construct($idTransaksi) { $this->idTransaksi = $idTransaksi; }
    }

    // --- jalankan semua dan tampilkan di tabel ---
    $logs = [];

    $buku = new Buku("White Nights", 1848, "978-0-241-2508-6");
    $logs[] = $buku->pinjam();

    $dvd = new DVD("KPop Demon Hunters", 2025, 100);
    $logs[] = $dvd->pinjam();

    $majalah = new Majalah("Black Tie Affair", 2023, "Summer/Spring");
    $logs[] = $majalah->pinjam();

    $pengguna = new Pengguna("Khairunnisa");
    $logs[] = $pengguna->logActivity("Login berhasil.");
    $logs[] = $pengguna->sendNotification("Selamat datang, {$pengguna->nama}!");

    $produk = new Produk("Enola Holmes");
    $logs[] = $produk->logActivity("Produk ditambahkan ke katalog.");
    $logs[] = $produk->search("DVD");

    $transaksi = new Transaksi("TRX001");
    $logs[] = $transaksi->logActivity("Transaksi dibuat.");
    $logs[] = $transaksi->sendNotification("Pembayaran berhasil.");
    $logs[] = $transaksi->search("TRX001");

    foreach ($logs as $pesan) {
        echo "<tr><td>{$pesan}</td></tr>";
    }
    ?>
  </tbody>
</table>

</body>
</html>
