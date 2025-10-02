<?php
// --- AUTOLOADER DAN USE STATEMENT (Harus di bagian atas file) ---
spl_autoload_register(function ($class) {
    
    $base_dir = __DIR__ . '/src/';

    $relative_class = str_replace('AdopsiHewan\\', '', $class);

    $file_path = str_replace('\\', '/', $relative_class);

    $file = $base_dir . $file_path . '.php';
    
    if (file_exists($file)) {
        require_once $file;
    }
});

use AdopsiHewan\Models\Anjing;
use AdopsiHewan\Controllers\ManajemenAdopsi;
use AdopsiHewan\Utilities\Reflektor;
use AdopsiHewan\Interfaces\CrudInterface;

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Adopsi Hewan OOP PHP</title>
    <link rel="stylesheet" href="petstyle.css"> 
</head>
<body>
<div class="container">
    <h1>Adopt a Bit</h1>
    <p>Cute pets are waiting for you!</p>

    <pre>
<?php

$reflector = new Reflektor();
$manajemen = new ManajemenAdopsi($reflector); 

try {
    $anjing1 = new Anjing("Bolt", 36, "Golden Retriever", "Tinggi");
    $anjing2 = new Anjing("Lassie", 12, "Border Collie", "Sedang");

    echo "--- DETAIL HEWAN ---\n";
    echo "Nama Anjing 1 (public): " . $anjing1->nama . "\n";
    echo "Umur Anjing 1 (private via method): " . $anjing1->getUmurTahun() . " tahun\n";
    
    echo $anjing1->bersuara() . "\n";
    
    echo $anjing1->tampilkanStatus() . "\n"; 
    
    echo "Detail: " . $anjing1 . "\n"; 
    
    echo "Status Default (Constant): " . Anjing::STATUS_ADOP . "\n";
    
    echo $anjing1->tampilkanEnergi() . "\n";
    
    echo "Kategori Hewan (Static::class): " . Anjing::getKategori() . "\n";

    $manajemen->buat(['nama' => $anjing2->nama, 'ras' => $anjing2->getRas(), 'energi' => $anjing2->tampilkanEnergi()]);
    $dataAdopsi = $manajemen->baca(1);
    echo "Data Adopsi ID 1: " . ($dataAdopsi ? $dataAdopsi['nama'] : 'Tidak ada') . "\n";
    $manajemen->perbarui(1, ['status_adopsi' => 'Diadopsi']);
    echo "Status Baru ID 1: " . $manajemen->baca(1)['status_adopsi'] . "\n";
    $manajemen->hapus(1);

    $anjing3 = clone $anjing1;
    $anjing3->nama = "Duplikat Bolt"; 
    echo "Anjing 3 Nama: " . $anjing3->nama . "\n";

    echo "--- ITERASI PROPERTI PUBLIK ANJING 2 ---\n";
    foreach ($anjing2 as $key => $value) {
        if (is_string($value)) {
            echo "{$key}: {$value}\n";
        }
    }
    echo "----------------------------------------\n";

    $serializedAnjing = serialize($anjing2);
    echo "Objek Anjing 2 diserialisasi.\n";
    
    $unserializedAnjing = unserialize($serializedAnjing);
    echo "Objek Anjing 2 diunserialisasi: " . $unserializedAnjing->nama . "\n";

    $emailSender = new class implements CrudInterface {
        public function buat(array $data): void { echo "AC: Mengirim email konfirmasi...\n"; }
        public function baca(int $id): ?array { return null; }
        public function perbarui(int $id, array $data): bool { return false; }
        public function hapus(int $id): bool { return false; }
    };

    $emailSender->buat(['penerima' => 'adopter@example.com']);
    
} catch (\InvalidArgumentException $e) {
    echo "\n\n--- ERROR ---\n";
    echo "ERROR: " . $e->getMessage() . "\n";
}
// Tidak ada tag penutup ?> di sini, karena kode PHP berlanjut sampai akhir file.
// Ini memastikan semua output terkirim sebelum </body>
?>
    </pre>
</div>
</body>
</html>