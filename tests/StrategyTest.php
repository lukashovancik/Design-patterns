<?php

interface Logger
{
    public function log($data);
}

class LogToFile implements Logger
{

    public function log($data)
    {
        return 'Ukladám log do súboru:' . $data;
    }
}

class LogToDatabase implements Logger
{

    public function log($data)
    {
        return 'Ukladám log do databázy:' . $data;
    }
}


class App
{
    public function log($data, Logger $logger = null)
    {

        if (!$logger) {
            $logger = new LogToFile();
        }

        return $logger->log($data);
    }
}


class StrategyTest extends PHPUnit_Framework_TestCase
{

    /**
     * Test log záznam uloží do súboru
     */
    public function test_is_saved_log_to_file()
    {
        $app = new App();
        $this->assertEquals($app->log('data', new LogToFile),"Ukladám log do súboru:data");
    }

    /**
     * Test log záznam uloží do databázy
     */
    public function test_is_saved_log_to_database()
    {
        $app = new App();
        $this->assertEquals($app->log('data', new LogToDatabase),'Ukladám log do databázy:data');
    }

}
