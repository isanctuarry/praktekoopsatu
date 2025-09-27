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
        }

        class Persegi implements BangunDatar {
            private $sisi;

            public function __construct($sisi) {
                $this->sisi = $sisi;
            }

            public function luas() {
                return $this->sisi * $this->sisi;
            }
        }

        class Lingkaran implements BangunDatar {
            private $jari2;

            public function __construct($jari2) {
                $this->jari2 = $jari2;
            }

            public function luas() {
                return $this->jari2 * $this->jari2;
            }
        }
        
        $bangunDatar = [
            new Persegi(6),
            new Lingkaran(8)
        ];

        foreach ($bangunDatar as $BD) {
            echo "Luas: ". $BD->luas() . "<br> <br>";
        }
    


