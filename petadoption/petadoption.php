<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Adopsi Hewan OOP PHP</title>
    <link rel="stylesheet" href="petstyle.css"> 
</head>
<body>
<div class="container">
    <h1>Pets</h1>
    </div>
<div class="header">
    <h1>Adopt a Bit</h1>
    <p>Cute pets are waiting for you!</p>
</div>
</body>
</html>

<?php
// File: petadoption.php

spl_autoload_register(function ($class) {
    
    // 1. Definisikan jalur dasar (base directory)
    // __DIR__ adalah C:\SISTEM INFORMASI\...\praktikoopspatu\
    $base_dir = __DIR__ . '/src/';

    // 2. Hapus namespace root 'AdopsiHewan\'
    // Hasil: Utilities\Reflektor
    $relative_class = str_replace('AdopsiHewan\\', '', $class);

    // 3. Ubah semua backslash (\) menjadi slash (/)
    // Hasil: Utilities/Reflektor
    $file_path = str_replace('\\', '/', $relative_class);

    // 4. Gabungkan base_dir, path, dan ekstensi
    // Hasil: C:\SISTEM INFORMASI\...\praktikoopspatu/src/Utilities/Reflektor.php
    $file = $base_dir . $file_path . '.php';
    
    // Cek path yang dicari oleh PHP di Windows
    // echo "Mencari file: " . $file . "\n"; 
    // die; 

    if (file_exists($file)) {
        require_once $file;
    }
});

use AdopsiHewan\Models\Anjing;
use AdopsiHewan\Controllers\ManajemenAdopsi;
use AdopsiHewan\Utilities\Reflektor;


// IMPLEMENTASI

// 18. Dependency Injection (lanjutan)
$reflector = new Reflektor();
$manajemen = new ManajemenAdopsi($reflector); 
// Output refleksi dari ManajemenAdopsi muncul di sini

try {
    // 3. Magic Methods: __construct()
    $anjing1 = new Anjing("Bolt", 36, "Golden Retriever", "Tinggi");
    $anjing2 = new Anjing("Lassie", 12, "Border Collie", "Sedang");

    echo "--- Detail Hewan ---\n";
    // 1. Scope (public property)
    echo "Nama Anjing 1 (public): " . $anjing1->nama . "\n";
    // 2. Encapsulation (via getter)
    echo "Umur Anjing 1 (private via method): " . $anjing1->getUmurTahun() . " tahun\n";
    
    // 11. Polymorphism (override abstract method bersuara)
    echo $anjing1->bersuara() . "\n";
    
    // 3. Magic Methods: __call()
    echo $anjing1->tampilkanStatus() . "\n"; 
    
    // 3. Magic Methods: __toString()
    echo "Detail: " . $anjing1 . "\n"; 
    
    // 5. Class Constants
    echo "Status Default (Constant): " . Anjing::STATUS_ADOP . "\n";
    
    // 7. Final Keyword (final function)
    echo $anjing1->tampilkanEnergi() . "\n";
    
    // 12. Static Properties & Methods (self:: vs static:: - Late Static Binding)
    echo "Kategori Hewan (Static::class): " . Anjing::getKategori() . "\n";

    // 9. Exception Handling (try-catch)
    // $anjingInvalid = new Anjing("Bayi", 0, "Ras A", "Rendah"); 

    // 14. Penerapan CRUD
    $manajemen->buat(['nama' => $anjing2->nama, 'ras' => $anjing2->getRas(), 'energi' => $anjing2->tampilkanEnergi()]);
    $dataAdopsi = $manajemen->baca(1);
    echo "Data Adopsi ID 1: " . ($dataAdopsi ? $dataAdopsi['nama'] : 'Tidak ada') . "\n";
    $manajemen->perbarui(1, ['status_adopsi' => 'Diadopsi']);
    echo "Status Baru ID 1: " . $manajemen->baca(1)['status_adopsi'] . "\n";
    $manajemen->hapus(1);

    // 19. Cloning Object & Magic Methods __clone()
    $anjing3 = clone $anjing1; // Duplikasi objek
    $anjing3->nama = "Duplikat Bolt"; // Modifikasi salinan
    echo "Anjing 3 Nama: " . $anjing3->nama . "\n";

    // 16. Object Iteration: Menggunakan `foreach` untuk mengiterasi properti publik
    echo "--- Iterasi Properti Publik Anjing 2 ---\n";
    foreach ($anjing2 as $key => $value) {
        if (is_string($value)) {
            echo "{$key}: {$value}\n";
        }
    }
    echo "----------------------------------------\n";

    // 15. Object Serialization: serialize(), unserialize()
    $serializedAnjing = serialize($anjing2);
    echo "Objek Anjing 2 diserialisasi.\n";
    
    $unserializedAnjing = unserialize($serializedAnjing);
    echo "Objek Anjing 2 diunserialisasi: " . $unserializedAnjing->nama . "\n";

    // 20. Anonymous Class (PHP 7+)
    $emailSender = new class implements \AdopsiHewan\Interfaces\CrudInterface {
        public function buat(array $data): void { echo "AC: Mengirim email konfirmasi...\n"; }
        public function baca(int $id): ?array { return null; }
        public function perbarui(int $id, array $data): bool { return false; }
        public function hapus(int $id): bool { return false; }
    };

    $emailSender->buat(['penerima' => 'adopter@example.com']);
    
} catch (\InvalidArgumentException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
// 3. Magic Methods: __destruct() akan dipanggil saat skrip selesai.
?>