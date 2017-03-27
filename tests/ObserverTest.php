<?php


class Newspaper implements SplSubject{

    private $name;
    private $observers = array();
    private $title;

    public function __construct($name) {
        $this->name = $name;
    }


    //add observer
    public function attach(\SplObserver $observer) {
        $this->observers[] = $observer;
    }

    public function detach(\SplObserver $observer) {

        $key = array_search($observer,$this->observers, true);
        if($key){
            unset($this->observers[$key]);
        }
    }

    public function notify() {
        foreach ($this->observers as $value) {
            $value->update($this);
        }
    }

    public function breakOutNews($content) {
        $this->title = $content;
        $this->notify();
    }

    public function getTitle() {
        return $this->title;
    }

    public function getName()
    {
        return $this->name;
    }

}


class Reader implements SplObserver{

    private $name;

    public $actualReading;
    public $actualNewspaper;

    public function __construct($name) {
        $this->name = $name;
    }

    public function update(\SplSubject $subject) {
        $this->actualReading =  $subject->getTitle();
        $this->actualNewspaper = $subject->getName();
    }
}



class ObserverTest extends PHPUnit_Framework_TestCase
{
    /*
    *test odber noviniek
    */
    public function test_is_the_same_object()
    {
        $newspaper = new Newspaper('dennikn');

        //vytovrenie čtateľov
        $peter = new Reader('Peter');
        $jozef = new Reader('Jozef');
        $martin = new Reader('Martin');

        //pridanie odberu
        $newspaper->attach($peter);
        $newspaper->attach($jozef);
        $newspaper->attach($martin);

        //zrušenie odberu
        $newspaper->detach($martin);

        //pridanie horúcej novinky
        $newspaper->breakOutNews('V Prešove sa zrazili autá!');

        $this->assertEquals($martin->actualReading,null);
        $this->assertEquals($jozef->actualReading,'V Prešove sa zrazili autá!');
        $this->assertEquals($peter->actualReading,'V Prešove sa zrazili autá!');
    }
}