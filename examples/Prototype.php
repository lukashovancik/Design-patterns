<?php

namespace App;

    class Person {
        protected $name;
        protected $surname;
        protected $age;
        protected $height;
        protected $weight;

        /**
         * Person constructor.
         * @param $name
         * @param $surname
         * @param $age
         * @param $height
         * @param $weight
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
         * @param mixed $name
         */
        public function setName($name)
        {
            $this->name = $name;
        }

        /**
         * @param mixed $surname
         */
        public function setSurname($surname)
        {
            $this->surname = $surname;
        }

        /**
         * @param mixed $age
         */
        public function setAge($age)
        {
            $this->age = $age;
        }

        /**
         * @param mixed $height
         */
        public function setHeight($height)
        {
            $this->height = $height;
        }

        /**
         * @param mixed $weight
         */
        public function setWeight($weight)
        {
            $this->weight = $weight;
        }

        public function __clone()
        {

        }

    }