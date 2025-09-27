<?php

abstract class  Kendaraan {
abstract public function bergerak();
}

class Mobil extends Kendaraan {
    public function bergerak() {
        echo "Mobil berjalan dengan 4 roda <br>";
    }}

class Motor extends Kendaraan {
    public function bergerak() {
        echo "Motor bergerak dengan 2 roda <br>";
}
}