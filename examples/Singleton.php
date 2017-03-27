<?php

namespace App;


/*
 * Trieda Database
 */
class Database
{

    /**
     * @var $dbName - názov databázy
     * @var $dbHost - hostiteľ
     * @var $dbPass - heslo
     * @var $dbUser - použivateľ
     */
    private $dbName = null,
            $dbHost = null,
            $dbPass = null,
            $dbUser = null;

    /**
     * @var $instance - zdieľaná súkromná inštancia
     */
    private static $instance = null;

    /**
     * Konštruktor triedy Databáza
     * Nastaví projenie databázy pomocou vytvorenia inštancie PDO
     * ovládača do PDO pošle nastavenia v @param array $dbDetails
     *
     * @param array $dbDetails - pole nastavení databázy
     */
    private function __construct($dbDetails = array())
    {

        $this->dbName = $dbDetails['db_name'];
        $this->dbHost = $dbDetails['db_host'];
        $this->dbUser = $dbDetails['db_user'];
        $this->dbPass = $dbDetails['db_pass'];

        $this->dbh = new PDO('mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName, $this->dbUser, $this->dbPass);
    }

    /**
     * Metóda connect
     * Skontroluje , či už máme uloženú inštanciu a
     * vráti ju , ak nie , vytovorí ju a uloží
     * do statickej premmennej a vráti ju
     *
     * @param array $dbDetails - nastavenia databázy
     * @return Database|null
     */
    public static function connect($dbDetails = array())
    {

        if (self::$instance == null) {
            self::$instance = new Database($dbDetails);
        }

        return self::$instance;

    }

    /**
     * Metóda _clone
     * Zabráni klonovaniu objektu, kedže je súkromna
     */
    private function __clone()
    {

    }

    /**
     * Metóda _wakeup
     * Zabráni použitiu funkcie unserliaze, kedže je súkromna
     */
    private function __wakeup()
    {

    }

}


/********************** POUŽITIE **************************/

//global.php

//vytvorí sa zdieľaná inštancia triedy Database
Database::connect([
    'db_name' => 'eshop',
    'db_host' => 'localhost',
    'db_user' => 'root',
    'db_pass' => 'heslo'
]);


//local1.php
include 'global.php';

/**
 * Pomocu volania statickej metódy connect bez parametrov
 * sa vráti zdieľaná inštancia triedy Database
 **/
$database = Database::connect();

//local2.php
include 'global.php';

/**
 * Pomocu volania statickej metódy connect bez parametrov
 * sa vráti zdieľaná inštancia triedy Database
 **/
$database = Database::connect();




