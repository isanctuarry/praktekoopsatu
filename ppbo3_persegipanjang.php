<?php 
class PersegiPanjang {
    //property
    private $panjang;
    private $lebar;
    
    public function __construct ($panjang, $lebar) {
        $this->lebar = $lebar;
        $this->panjang = $panjang;
    }

    public function luas(){
        return $this->panjang * $this->lebar;
    } 
    
    public function keliling(){
        return 2 * ($this->panjang + $this ->lebar);
    }
}

$pp = new PersegiPanjang(8, 5);
echo "Luas Persegi Panjang: " . $pp->luas() . "\n";
echo "Keliling Persegi Panjang: " . $pp->keliling() . "\n";
?>