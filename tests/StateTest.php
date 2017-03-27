<?php


interface EbookState
{
    public function open();

    public function close();

    public function read();
}

interface EbookInteface
{
    const STATE_CLOSE = 0;
    const STATE_OPEN = 1;
    const STATE_READ = 2;

    public function setState(EbookState $state);

    public function getState($stateId);
}

abstract class EbookAbstractState implements EbookState
{

    protected $ebook;

    public function __construct(Ebook $ebook)
    {
        $this->ebook = $ebook;
    }
}

class OpenedEbookState extends EbookAbstractState
{

    public function open()
    {
        throw new BadMethodCallException("Kniha už je otvorená.");
    }

    public function close()
    {
        $this->ebook->setState($this->ebook->getState(Ebook::STATE_CLOSE));
    }

    public function read()
    {
        $this->ebook->setState($this->ebook->getState(Ebook::STATE_READ));
    }
}

class ReadEbookState extends EbookAbstractState
{

    public function open()
    {
        throw new BadMethodCallException("Kniha už je otvorená");
    }

    public function close()
    {
        $this->ebook->setState($this->ebook->getState(Ebook::STATE_CLOSE));
    }

    public function read()
    {
        return 'Číta sa kniha';
    }
}

class ClosedEbookState extends EbookAbstractState
{

    public function open()
    {
        $this->ebook->setState($this->ebook->getState(Ebook::STATE_OPEN));
    }

    public function close()
    {
        throw new BadMethodCallException("Kniha už bola zatvorená");
    }

    public function read()
    {
        throw new BadMethodCallException("Kniha je zatvorená. Nieje možné čítať. ");
    }
}

class Ebook implements EbookInteface
{

    protected $state;
    protected $states = [];
    protected $type;

    public function __construct($type)
    {
        $this->type = $type;
        $this->states[Ebook::STATE_CLOSE] = new ClosedEbookState($this);
        $this->states[Ebook::STATE_OPEN] = new OpenedEbookState($this);
        $this->states[Ebook::STATE_READ] = new ReadEbookState($this);

        $this->state = $this->getState(Ebook::STATE_CLOSE);
    }

    public function setState(EbookState $state)
    {
        $this->state = $state;
    }

    public function getState($stateId)
    {
        return $this->states[$stateId];
    }

    public function getActualState()
    {
        return $this->state;
    }

    public function open()
    {
        $this->state->open();
    }

    public function close()
    {
        $this->state->close();
    }

    public function read()
    {
        $this->state->read();
    }
}

class StateTest extends PHPUnit_Framework_TestCase
{
    /*
     *test stavu otverá nkiha
     */
    public function test_is_open_book()
    {
        $ebook = new Ebook('Amazon kindle');
        $ebook->open();
        $this->expectException(BadMethodCallException::class);
        $ebook->open();
        $this->assertInstanceOf(OpenedEbookState::class, $ebook->getActualState());
    }

    /*
     *test stavu práve sa číta
     */

    public function test_is_read_book()
    {
        $ebook = new Ebook('Amazon kindle');
        $ebook->open();
        $ebook->read();
        $ebook->read();
        $ebook->read();
        $this->assertInstanceOf(ReadEbookState::class, $ebook->getActualState());
    }

    /*
     *test stavu zatvorená kniha
     */

    public function test_is_close_book()
    {
        $this->expectException(BadMethodCallException::class);

        $ebook = new Ebook('Amazon kindle');
        $ebook->open();
        $ebook->read();
        $ebook->close();
        $ebook->close();
        $this->assertInstanceOf(ClosedEbookState::class, $ebook->getActualState());
    }
}