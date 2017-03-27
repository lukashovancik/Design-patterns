<?php


abstract class AbstractCar {


    protected $species;


    public function getSpecies()
    {
        return $this->species;
    }
}


class AudiOffRoadT1 extends AbstractCar {

    protected $species = 'Audi T1';
}


class AudiOffRoadT2 extends AbstractCar {

    protected $species = 'Audi T2';

}


class AudiPersonalA5 extends AbstractCar {

    protected $species = 'Audi A5';
}

class AudiPersonalA6 extends AbstractCar {

    protected $species = 'Audi A6';

}


class AudiTruckN1 extends AbstractCar {

    protected $species = 'Audi N1';

}

class AudiTruckN2 extends AbstractCar {


    protected $species = 'Audi N2';

}


interface CarFactoryInterface
{
    public static function build($car);

}



class OffRoadCarFactory implements CarFactoryInterface
{
    public static function build($car)
    {
        switch ($car) {
            case 't1':
                $obj = new AudiOffRoadT1();
                break;
            case 't2':
                $obj = new AudiOffRoadT2();
                break;
            default:
                throw new Exception("TerenneCar továreň nemôže vytvoriť terenné auto so špecifikáciou '" . $car . "'", 1000);
        }
        return $obj;
    }
}

class PersonalCarFactory implements CarFactoryInterface
{
    public static function build($car)
    {
        switch ($car) {
            case 'a5':
                $obj = new AudiPersonalA5();
                break;
            case 'a6':
                $obj = new AudiPersonalA6();
                break;
            default:
                throw new Exception("OsobneCar továreň nemôže vytvoriť terenné auto so špecifikáciou '" . $car . "'", 1000);
        }
        return $obj;
    }
}


class TruckCarFactory implements CarFactoryInterface
{
    public static function build($car)
    {
        switch ($car) {
            case 'n1':
                $obj = new AudiTruckN1();
                break;
            case 'n2':
                $obj = new AudiTruckN2();
                break;
            default:
                throw new Exception("Nakladne továreň nemôže vytvoriť terenné auto so špecifikáciou '" . $car . "'", 1000);
        }
        return $obj;
    }
}



class FactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * test vytvorenia audi t1
     */
    public function test_return_audi_t1()
    {
        $audi = OffRoadCarFactory::build('t1');
        $this->assertEquals('Audi T1',$audi->getSpecies());
    }

    /**
     * test vytvorenia audi t2
     */
    public function test_return_audi_t2()
    {
        $audi = OffRoadCarFactory::build('t2');
        $this->assertEquals('Audi T2',$audi->getSpecies());
    }

    /**
     * test vytvorenia audi a5
     */
    public function test_return_personal_a5()
    {
        $audi = PersonalCarFactory::build('a5');
        $this->assertEquals('Audi A5',$audi->getSpecies());
    }

    /**
     * test vytvorenia audi a6
     */
    public function test_return_personal_a6()
    {
        $audi = PersonalCarFactory::build('a6');
        $this->assertEquals('Audi A6',$audi->getSpecies());
    }

    /**
     * test vytvorenia audi n1
     */
    public function test_return_truck_n1()
    {
        $audi = TruckCarFactory::build('n1');
        $this->assertEquals('Audi N1',$audi->getSpecies());
    }

    /**
     * test vytvorenia audi n2
     */
    public function test_return_truck_n2()
    {
        $audi = TruckCarFactory::build('n2');
        $this->assertEquals('Audi N2',$audi->getSpecies());
    }


    /**
     * test výnimky, pre neočakvaný typ automobilu
     * @expectedException Exception
     */
    public function testException()
    {
        TruckCarFactory::build('a5');
    }


}