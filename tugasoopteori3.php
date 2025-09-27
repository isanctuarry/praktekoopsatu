<?php

            abstract class  Kendaraan {
            abstract public function jalan();
            }

            class Mobil extends Kendaraan {
                public function jalan() {
                    echo "Mobil Porsche Taycan berjalan dengan 4 roda <br>";
            }
            }

            class Motor extends Kendaraan {
                public function jalan() {
                    echo "Motor Yamaha YZF-R1 berjalan dengan 2 roda <br>";
            }
            }

            $motor1 = new Motor();
            $motor1->jalan();
            $mobil1 = new Mobil();
            $mobil1->jalan();

    


