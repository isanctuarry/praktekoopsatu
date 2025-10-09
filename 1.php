<?php
class AkunBank 
{
    protected $saldo = 0;
    
    public function setor()
            {
                return"Anda baru saja menyetorkan 500.000 \n";
            }

    public function tarik()
        {
            return"Tarik -100.000 \n";
        }
    public function getSaldo()
    {
        return $this->saldo;
        
    }
}

$akun = new AkunBank();
echo "Saldo saat ini: "  . $akun->getSaldo()."\n" ;
$akun->setor();
echo $akun->setor();
$akun->tarik();
echo $akun->tarik();
