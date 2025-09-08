<?php
class Segitiga {
    private $alas;
    private $tinggi;
    private $sisi1;
    private $sisi2;
    private $sisi3;

    public function __construct($a, $t, $s1, $s2, $s3) {
        $this->alas = $a;
        $this->tinggi = $t;
        $this->sisi1 = $s1;
        $this->sisi2 = $s2;
        $this->sisi3 = $s3;
    }

    public function hitungLuas() {
        return 0.5 * $this->alas * $this->tinggi;
    }

    public function hitungKeliling() {
        return $this->sisi1 + $this->sisi2 + $this->sisi3;
    }

    public function cekJenis() {
        if ($this->sisi1 == $this->sisi2 && $this->sisi2 == $this->sisi3) {
            return "Sama Sisi";
        } elseif (
            $this->sisi1 == $this->sisi2 ||
            $this->sisi2 == $this->sisi3 ||
            $this->sisi1 == $this->sisi3
        ) {
            return "Sama Kaki";
        } else {
            return "Sembarang";
        }
    }

    public function tampilkanInfo() {
        echo "===== INFORMASI SEGITIGA ======<br>";
        echo "Alas : " . $this->alas . "<br>";
        echo "Tinggi : " . $this->tinggi . "<br>";
        echo "Sisi : " . $this->sisi1 . ", " . $this->sisi2 . ", " . $this->sisi3 . "<br>";
        echo "Luas : " . $this->hitungLuas() . "<br>";
        echo "Keliling : " . $this->hitungKeliling() . "<br>";
        echo "Jenis : " . $this->cekJenis() . "<br>";
        echo "===============================<br><br>";
    }
}
?>
