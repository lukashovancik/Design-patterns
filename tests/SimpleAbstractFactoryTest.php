<?php


abstract class CarAbstract {

    protected $species;


    public function getSpecies()
    {
        return $this->species;
    }
}


class Audi extends CarAbstract {

    protected $species = 'audi';

}


class Skoda extends CarAbstract {

    protected $species = 'skoda';
}


class CarFactory {


    public static function build($car)
    {
        switch ($car){
            case 'audi':
                $obj = new Audi();
                break;
            case 'skoda':
                $obj = new Skoda();
                break;
            default:
                throw new Exception("CarFactory nemôže vytvoriť auto so špecifikáciou " . $car);
        }

        return $obj;
    }

}



class SimpleFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * test , či vrátený očakávaný objekt je typu škoda
     */
    public function test_is_returned_skoda(){
        $skoda = CarFactory::build('skoda');
        $this->assertEquals('skoda',$skoda->getSpecies());
    }

    /**
     * test , či vrátený očakávaný objekt je typu audi
     */
    public function test_is_returned_audi(){
        $audi = CarFactory::build('audi');
        $this->assertEquals('audi',$audi->getSpecies());
    }
}
