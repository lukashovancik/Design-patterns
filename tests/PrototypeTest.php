<?php

/**
 * Class Person
 * Reprezentuje osobu
 */
class Person {
    protected $name;
    protected $surname;
    protected $age;
    protected $height;
    protected $weight;

    /**
     * Person konštruktor
     * @param $name - meno
     * @param $surname - prezvisko
     * @param $age - vek
     * @param $height - vyška
     * @param $weight - váha
     */

    public function __construct($name, $surname, $age, $height, $weight)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
        $this->height = $height;
        $this->weight = $weight;
    }

    /**
     * Setter Name
     * @param mixed $name - meno
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Setter Surname
     * @param mixed $surname - priezvisko
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * Setter Age
     * @param mixed $age - vek
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * Setter Height
     * @param mixed $height - výška
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * Setter Weight
     * @param mixed $weight - váha
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * Metóda __clone
     * Musí byť verejná , aby bolo možné
     * klonovať objekt
     */
    public function __clone()
    {

    }

}


/**
 * Class PrototypeTest - testovacia trieda
 */
class PrototypeTest extends PHPUnit_Framework_TestCase
{
    /*
     *test , čí klovaný objekt je rovnaký ako jeho originál
     */
    public function test_is_the_same_object()
    {
        $lukas = new Person('Lukas','Hovancik','18','180','50');
        $lukasCopy = clone $lukas;

        $this->assertEquals($lukas,$lukasCopy);
    }
}