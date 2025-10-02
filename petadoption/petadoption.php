<?php
// --- AUTOLOADER DAN USE STATEMENT ---
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

// TANGKAP SEMUA OUTPUT DENGAN BUFFERING (ob_start() harus dipanggil di awal!)
ob_start();

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

<?php
try {
    // INISIALISASI DIPINDAHKAN KE SINI (Setelah ob_start)
    $reflector = new Reflektor();
    $manajemen = new ManajemenAdopsi($reflector); 
    
    // 3. Magic Methods: __construct()
    $anjing1 = new Anjing("Bolt", 36, "Golden Retriever", "Tinggi");
    $anjing2 = new Anjing("Lassie", 12, "Border Collie", "Sedang");

    // --- 1. DETAIL HEWAN & MAGIC METHODS ---
    ?>
    <h2>1. Detail Hewan, Encapsulation & Magic Methods</h2>
    <div class="result-block">
        <?php
        echo "<strong>Nama (public):</strong> " . $anjing1->nama . "<br>";
        echo "<strong>Umur (private via getter):</strong> " . $anjing1->getUmurTahun() . " tahun<br>";
        echo "<strong>Polymorphism (Suara):</strong> " . $anjing1->bersuara() . "<br>";
        echo "<strong>Magic Method __call():</strong> " . $anjing1->tampilkanStatus() . "<br>"; 
        // Menggunakan <pre> untuk output multiline __toString()
        echo "<strong>Magic Method __toString():</strong> <pre>" . $anjing1 . "</pre>"; 
        ?>
    </div>

    <h2>2. Constants, Final Keyword & Static Binding</h2>
    <div class="result-block">
        <?php
        echo "<strong>Class Constants:</strong> Status Default: " . Anjing::STATUS_ADOP . "<br>";
        echo "<strong>Final Function:</strong> Tingkat Energi: " . $anjing1->tampilkanEnergi() . "<br>";
        echo "<strong>Static Binding:</strong> Kategori: " . Anjing::getKategori() . "<br>";
        ?>
    </div>

    <h2>3. Penerapan CRUD (Interface)</h2>
    <div class="result-block">
        <?php
        $manajemen->buat(['nama' => $anjing2->nama, 'ras' => $anjing2->getRas(), 'energi' => $anjing2->tampilkanEnergi()]);
        $dataAdopsi = $manajemen->baca(1);
        echo "<strong>Data Adopsi ID 1 Dibaca:</strong> " . ($dataAdopsi ? $dataAdopsi['nama'] : 'Tidak ada') . "<br>";
        $manajemen->perbarui(1, ['status_adopsi' => 'Diadopsi']);
        echo "<strong>Status Baru ID 1:</strong> " . $manajemen->baca(1)['status_adopsi'] . "<br>";
        $manajemen->hapus(1);
        echo "Data Adopsi ID 1 Dihapus.<br>";
        ?>
    </div>

    <h2>4. Cloning, Iteration, Serialization & Anonymous Class</h2>
    <div class="result-block">
        <?php
        $anjing3 = clone $anjing1;
        $anjing3->nama = "Duplikat Bolt";
        echo "<strong>Cloning Object:</strong> Anjing 3 Nama: " . $anjing3->nama . "<br>";

        echo "<strong>Object Iteration (Properti Publik):</strong><pre>";
        foreach ($anjing2 as $key => $value) {
            if (is_string($value)) {
                echo "{$key}: {$value}\n";
            }
        }
        echo "</pre>";

        $serializedAnjing = serialize($anjing2);
        echo "Objek Anjing 2 diserialisasi.<br>";
        $unserializedAnjing = unserialize($serializedAnjing);
        echo "Objek Anjing 2 diunserialisasi: <strong>" . $unserializedAnjing->nama . "</strong><br>";

        $emailSender = new class implements CrudInterface {
            public function buat(array $data): void { echo "<strong>Anonymous Class:</strong> AC: Mengirim email konfirmasi...<br>"; }
            public function baca(int $id): ?array { return null; }
            public function perbarui(int $id, array $data): bool { return false; }
            public function hapus(int $id): bool { return false; }
        };
        $emailSender->buat(['penerima' => 'adopter@example.com']);
        ?>
    </div>
    
    <?php
} catch (\InvalidArgumentException $e) {
    // --- 5. EXCEPTION HANDLING ---
    ?>
    <h2>5. Exception Handling (ERROR)</h2>
    <div class="result-block error-block">
        <?php echo "ERROR: <pre>" . htmlspecialchars($e->getMessage()) . "</pre>"; ?>
    </div>
    <?php
}

// --- TANGKAP DAN TAMPILKAN LOG & REFLEKSI DI BAGIAN AKHIR ---
$log_output = ob_get_clean(); // Mengakhiri buffering dan mendapatkan output
$log_entries = explode("\n", $log_output);
?>

<h2>6. Log (Trait) & Reflection Output</h2>
<div class="result-block log-block">
    <?php
    foreach ($log_entries as $entry) {
        if (trim($entry) !== '') {
            // Ini akan membungkus setiap baris Log/Refleksi ke dalam div terpisah
            echo "<div class='log-entry'>" . htmlspecialchars($entry) . "</div>";
        }
    }
    ?>
</div>

</div>
</body>
</html>