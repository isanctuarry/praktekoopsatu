<?php
class AppConfig {
    public $version = "1.0.0";
    const APP_NAME = "MyApp";

    public function ubahVersi($versiBaru) {
        $this->version = $versiBaru;
    }

    public function info() {
        echo "Aplikasi: " . self::APP_NAME . " (versi " . $this->version . ")";
    }
}

$config = new AppConfig();
$config->ubahVersi("2.0.0");
$config->info();
