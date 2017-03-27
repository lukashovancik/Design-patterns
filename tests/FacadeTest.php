<?php

class Plus
{
    public function addition($a, $b)
    {
        return $a + $b;
    }
}

class Minus
{
    public function subtraction($a, $b)
    {
        return $a - $b;
    }
}

class Multiplier
{
    public function multiply($a, $b)
    {
        return $a * $b;
    }
}

class Divider
{
    public function divide($a, $b)
    {
        if ($b == 0) {
            throw new Exception('Delenie nulou.');
        }
        return $a / $b;
    }
}

class CalculatorFacade
{
    public function __construct(Plus $plus,
                                Minus $minus,
                                Multiplier $multiplier,
                                Divider $divider)
    {
        $this->plus = $plus;
        $this->minus = $minus;
        $this->multiplier = $multiplier;
        $this->divider = $divider;
    }

    public function calculate($expression)
    {
        list ($a, $operator, $b) = explode(' ', $expression);
        switch ($operator) {
            case '+':
                return $this->plus->addition($a, $b);
                break;
            case '-':
                return $this->minus->subtraction($a, $b);
                break;
            case '*':
                return $this->multiplier->multiply($a, $b);
                break;
            case '/':
                return $this->divider->divide($a, $b);
                break;
        }
    }
}


class FacadeTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->facade = new CalculatorFacade(new Plus(),new Minus(),new Multiplier(),new Divider());
    }

    //test sčítanie
    public function test_addition()
    {
        $this->assertEquals($this->facade->calculate('3 + 3'),6);
    }

    //test odčítanie
    public function test_subtraction()
    {
        $this->assertEquals($this->facade->calculate('3 - 3'),0);
    }

    //test násobenie
    public function test_multiply()
    {
        $this->assertEquals($this->facade->calculate('3 * 3'), 9);
    }

    //test delenie
    public function test_divide()
    {
        $this->assertEquals($this->facade->calculate('3 / 3'), 1);
    }
}




