<?php

namespace App;

    //Všetky autá by mali dediť z tejto abstraktnej triedy
    abstract class CarAbstract {

        //$species definuje typ auta
        protected $species;

        //metóda get vráti typ auta
        public function getSpecies()
        {
            return $this->species;
        }
    }


    //reprezentuje auto Audi
    class Audi extends CarAbstract {

        protected $species = 'audi';

    }

    //reprezentuje auto Skoda
    class Skoda extends CarAbstract {

        protected $species = 'skoda';
    }

    //Vytvorí konkretný typ auta
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
