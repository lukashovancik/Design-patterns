
<?php

namespace App;

//Všetky automobily by mali dediť z tejto abstraktnej triedy
abstract class CarAbstract {

    //$species definuje typ auta
    protected $species;

    //metóda get vráti typ auta
    public function getSpecies()
    {
        return $this->species;
    }
}

class AudiTerenneT1 extends CarAbstract {

    protected $species = 'Audi T1';

}

class AudiTerenneT2 extends CarAbstract {

    protected $species = 'Audi T2';

}

class AudiOsobneA5 extends CarAbstract {

    protected $species = 'Audi A5';

}

class AudiOsobneA6 extends CarAbstract {

    protected $species = 'Audi A6';

}

class AudiNakladneN1 extends CarAbstract {

    protected $species = 'Audi N1 ';

}

class AudiNakladneN2 extends CarAbstract {

    protected $species = 'Audi N2 ';

}


interface CarFactoryInterface
{
    public static function build($car);

}


class TerenneCarFactory implements CarFactoryInterface
{
    public static function build($car)
    {
        switch ($car) {
            case 't1':
                $obj = new AudiTerenneT1();
                break;
            case 't2':
                $obj = new AudiTerenneT2();
                break;
            default:
                throw new Exception("TerenneCar továreň nemôže vytvoriť terenné auto so špecifikáciou '" . $car . "'", 1000);
        }
        return $obj;
    }
}

class OsobneCarFactory implements CarFactoryInterface
{
    public static function build($car)
    {
        switch ($car) {
            case 'a5':
                $obj = new AudiOsobneA5();
                break;
            case 'a6':
                $obj = new AudiOsobneA6();
                break;
            default:
                throw new Exception("OsobneCar továreň nemôže vytvoriť terenné auto so špecifikáciou '" . $car . "'", 1000);
        }
        return $obj;
    }
}

class NakladneCarFactory implements CarFactoryInterface
{
    public static function build($car)
    {
        switch ($car) {
            case 'n1':
                $obj = new AudiNakladneN1();
                break;
            case 'n2':
                $obj = new AudiNakladneN2();
                break;
            default:
                throw new Exception("Nakladne továreň nemôže vytvoriť terenné auto so špecifikáciou '" . $car . "'", 1000);
        }
        return $obj;
    }
}