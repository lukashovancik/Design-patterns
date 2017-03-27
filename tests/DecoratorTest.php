<?php


interface CarPrice
{
    public function getCost();

    public function getDescription();
}


class BasePrice implements CarPrice
{

    public function getCost()
    {
        return 12000;
    }

    public function getDescription()
    {
        return "Cena za automobilu je {$this->getCost()} Eur";
    }
}


abstract class AbstractPriceDecorator implements CarPrice {

    protected $carPrice;

    public function __construct(CarPrice $carPrice)
    {
        $this->carPrice = $carPrice;
    }

}


class WinterTires extends AbstractPriceDecorator
{


    public function __construct(CarPrice $carPrice)
    {
        parent::__construct($carPrice);
    }


    public function getCost()
    {
        return $this->carPrice->getCost() + 200;
    }

    public function getDescription()
    {
        return "{$this->carPrice->getDescription()}, v cene aj zimné pneumatiky.";
    }
}



class OnboardComputer extends AbstractPriceDecorator
{

    public function __construct(CarPrice $carPrice)
    {
        parent::__construct($carPrice);
    }

    public function getCost()
    {
        return $this->carPrice->getCost() + 500;
    }

    public function getDescription()
    {
        return "{$this->carPrice->getDescription()}, v cene aj palubný počítač.";
    }
}


class EasyLightAssistant extends AbstractPriceDecorator
{

    public function __construct(CarPrice $carPrice)
    {
        parent::__construct($carPrice);
    }

    public function getCost()
    {
        return $this->carPrice->getCost() + 1000;
    }

    public function getDescription()
    {
        return "{$this->carPrice->getDescription()}, v cene aj svetelný senzor.";
    }
}



class DecoratorTest extends PHPUnit_Framework_TestCase
{
    /**
     * test základnej ceny automobilu
     */
    public function test_return_base_price_car()
    {
        $carPrice = new BasePrice();
        $this->assertEquals(12000, $carPrice->getCost());
    }

    /**
     * test ceny automobilu + zimné pneumatiky
     */
    public function test_return_price_with_winter_tires()
    {
        $carPrice = new WinterTires(new BasePrice());
        $this->assertEquals(12200, $carPrice->getCost());
    }

    /**
     * test ceny automobilu + zimné pneumatiky + palubný počítač
     */
    public function test_return_price_with_onboard_computer()
    {
        $carPrice = new OnboardComputer(new WinterTires(new BasePrice()));
        $this->assertEquals(12700, $carPrice->getCost());
    }

    /**
     * test ceny automobilu + zimné pneumatiky + palubný počítač + svetelný senzor
     */
    public function test_return_price_with_light_sensor()
    {
        $carPrice = new EasyLightAssistant(new OnboardComputer(new WinterTires(new BasePrice())));
        $this->assertEquals(13700, $carPrice->getCost());
    }
}