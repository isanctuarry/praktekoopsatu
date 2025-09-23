<?php
class Mahasiswa {
    public $nama;
    public $nim;
    public $prodi;
    public $angkatan;
    public $keterangan;

    // Constructor untuk mengisi data awal
    public function __construct($nama, $nim, $prodi, $angkatan, $keterangan) {
        $this->nama = $nama;
        $this->nim = $nim;
        $this->prodi = $prodi;
        $this->angkatan = $angkatan;
        $this->keterangan = $keterangan;
    }

    // Method untuk ambil keterangan
    public function getKeterangan() {
        return $this->keterangan;
    }
}

// Membuat 3 objek mahasiswa
$mhs1 = new Mahasiswa("Soob", "130030", "Astronomi", 2021, "Aktif");
$mhs2 = new Mahasiswa("Yeon", "139912", "Fashion Design", 2020, "Cuti");
$mhs3 = new Mahasiswa("Beom", "130113", "Desain Komunikasi Visual", 2021, "Keluar");

// Menampilkan keterangan masing-masing
echo $mhs1->nama . " (" . $mhs1->nim . ")" 
    . " - Prodi: " . $mhs1->prodi 
    . " - Angkatan: " . $mhs1->angkatan 
    . " - Status: " . $mhs1->getKeterangan() 
    . "<br>";

echo $mhs2->nama . " (" . $mhs2->nim . ")" 
    . " - Prodi: " . $mhs2->prodi 
    . " - Angkatan: " . $mhs2->angkatan 
    . " - Status: " . $mhs2->getKeterangan() 
    . "<br>";

echo $mhs3->nama . " (" . $mhs3->nim . ")" 
    . " - Prodi: " . $mhs3->prodi 
    . " - Angkatan: " . $mhs3->angkatan 
    . " - Status: " . $mhs3->getKeterangan() 
    . "<br>";


?>