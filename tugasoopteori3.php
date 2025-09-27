<?php
        //Abstraksi
            abstract class  Kendaraan {
            abstract public function jalan();
            }

            class Mobil extends Kendaraan {
                public function jalan() {
                    echo "Mobil Porsche Taycan berjalan dengan 4 roda <br> <br>";
            }
            }

            class Motor extends Kendaraan {
                public function jalan() {
                    echo "Motor Yamaha YZF-R1 berjalan dengan 2 roda <br> <br>";
            }
            }

            $motor1 = new Motor();
            $motor1->jalan();
            $mobil1 = new Mobil();
            $mobil1->jalan();
        
        //Polimorfusme
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
                . number_format($BD->luas(), 2) . "<br><br>";
}
    


