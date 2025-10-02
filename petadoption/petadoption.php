<?php
// ... (Bagian Autoloader Anda di sini) ...

use AdopsiHewan\Models\Anjing;
use AdopsiHewan\Controllers\ManajemenAdopsi;
use AdopsiHewan\Utilities\Reflektor;
use AdopsiHewan\Interfaces\CrudInterface; // Pastikan ini sudah di-use

// --- TAMPILAN HTML DIMULAI DI SINI ---
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Adopsi Hewan OOP PHP</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
<div class="container">
    <h1>Praktikum 7: Sistem Adopsi Hewan OOP</h1>

<?php
// ----------------------------------------------------
// IMPLEMENTASI
// ----------------------------------------------------

// Tangkap semua output (termasuk LOG dan Refleksi) ke buffer
ob_start();

try {
    // 3. Magic Methods: __construct()
    $anjing1 = new Anjing("Bolt", 36, "Golden Retriever", "Tinggi");
    $anjing2 = new Anjing("Lassie", 12, "Border Collie", "Sedang");

    ?>

    <h2>1. Scope, Encapsulation, Magic Methods (__construct, __call, __toString)</h2>
    <div class="result-block">
        <?php
        echo "<strong>1. Scope (public):</strong> Nama Anjing 1: " . $anjing1->nama . "<br>";
        echo "<strong>2. Encapsulation (private):</strong> Umur via method: " . $anjing1->getUmurTahun() . " tahun<br>";
        echo "<strong>3. Magic Method __call():</strong> Status: " . $anjing1->tampilkanStatus() . "<br>"; 
        echo "<strong>3. Magic Method __toString():</strong> Detail Objek:<pre>" . $anjing1 . "</pre>"; 
        ?>
    </div>

    <h2>2. Inheritance, Polymorphism, Constants, Final, Static</h2>
    <div class="result-block">
        <?php
        echo "<strong>4. Inheritance & 11. Polymorphism:</strong> Suara Anjing: " . $anjing1->bersuara() . "<br>";
        echo "<strong>5. Class Constants:</strong> Status Default: " . Anjing::STATUS_ADOP . "<br>";
        echo "<strong>7. Final Function:</strong> Tingkat Energi: " . $anjing1->tampilkanEnergi() . "<br>";
        echo "<strong>6. & 12. Late Static Binding:</strong> Kategori Hewan (Static::class): " . Anjing::getKategori() . "<br>";
        ?>
    </div>
    
    <h2>3. CRUD & Dependency Injection (Penerapan Interface & Reflection)</h2>
    <div class="result-block">
        <?php
        // 18. Dependency Injection (DI) & 17. Reflection (Reflektor di ManajemenAdopsi)
        $reflector = new Reflektor();
        $manajemen = new ManajemenAdopsi($reflector); 
        
        // 14. Penerapan CRUD
        $manajemen->buat(['nama' => $anjing2->nama, 'ras' => $anjing2->getRas(), 'energi' => $anjing2->tampilkanEnergi()]);
        $dataAdopsi = $manajemen->baca(1);
        echo "Data Adopsi ID 1 Dibaca: " . ($dataAdopsi ? "<strong>" . $dataAdopsi['nama'] . "</strong>" : 'Tidak ada') . "<br>";
        $manajemen->perbarui(1, ['status_adopsi' => 'Diadopsi']);
        echo "Status Baru ID 1 Diperbarui: <strong>" . $manajemen->baca(1)['status_adopsi'] . "</strong><br>";
        $manajemen->hapus(1);
        echo "Data Adopsi ID 1 Dihapus.<br>";
        ?>
    </div>

    <h2>4. Cloning, Serialization, Iteration & Anonymous Class</h2>
    <div class="result-block">
        <?php
        // 19. Cloning Object
        $anjing3 = clone $anjing1;
        $anjing3->nama = "Duplikat Bolt";
        echo "<strong>19. Cloning Object:</strong> Nama hasil clone adalah <strong>" . $anjing3->nama . "</strong><br>";

        // 16. Object Iteration
        echo "<strong>16. Object Iteration (foreach):</strong> Properti Publik Anjing 2:<pre>";
        foreach ($anjing2 as $key => $value) {
            if (is_string($value)) {
                echo "{$key}: {$value}\n";
            }
        }
        echo "</pre>";

        // 15. Object Serialization
        $serializedAnjing = serialize($anjing2);
        echo "<strong>15. Object Serialization:</strong> Objek Anjing diserialisasi.<br>";
        $unserializedAnjing = unserialize($serializedAnjing);
        echo "Objek Anjing diunserialisasi: <strong>" . $unserializedAnjing->nama . "</strong><br>";

        // 20. Anonymous Class (mengimplementasikan 10. Trait)
        $emailSender = new class implements CrudInterface {
            public function buat(array $data): void { echo "<strong>20. Anonymous Class:</strong> AC: Mengirim email konfirmasi adopsi...\n"; }
            public function baca(int $id): ?array { return null; }
            public function perbarui(int $id, array $data): bool { return false; }
            public function hapus(int $id): bool { return false; }
        };
        $emailSender->buat(['penerima' => 'adopter@example.com']);
        ?>
    </div>
    
    <?php
} catch (\InvalidArgumentException $e) {
    echo "<h2><span style='color: red;'>9. Exception Handling (ERROR)</span></h2>";
    echo "<div class='result-block' style='border-color: red;'>";
    echo "<pre style='color: red;'>" . htmlspecialchars($e->getMessage()) . "</pre>";
    echo "</div>";
}

// 3. Magic Methods: __destruct() akan dipanggil saat skrip selesai.

// --- TANGKAP DAN TAMPILKAN LOG & REFLEKSI DI BAGIAN AKHIR ---
$log_output = ob_get_clean();
$log_entries = explode("\n", $log_output);
?>

<h2>5. Trait (Log) & Reflection Output</h2>
<div class="result-block">
    <?php
    foreach ($log_entries as $entry) {
        if (trim($entry) !== '') {
            echo "<div class='log-entry'>" . htmlspecialchars($entry) . "</div>";
        }
    }
    ?>
</div>

</div>
</body>
</html>