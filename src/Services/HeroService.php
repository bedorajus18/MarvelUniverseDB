<?php
namespace App\Services;

use App\Entity\Hero;

class HeroService
    {
        private $_listeHeros = [];
        public $doctrine;
        public function getList(){
             {
        return $this->_listeHeros;
    }
        }
    
        function __construct()
        {
            $this->addHero(new Hero('Harley','MacKenzy','Harley Quinn',true,'une psychiatre reconvertie en psychotique'));
            $this->addHero(new Hero('Brice','Wayne','Batman',false,'une chauve souris avec une grosse super car'));
            $this->addHero(new Hero('Clark','Kent','Superman',false,'un extra-terrestre louche et journaliste'));
            $this->addHero(new Hero('Diana','Prince','Wonderwoman',false,'une amazonienne qui roske du poney'));
        }
   
    function addHero($pHero)
    {
        array_push($this->_listeHeros,$pHero);
    }
        public function getHero($pId)
        {
            $find = false;
            $hero = null;
            $i = 0; 
            while (($i < count($this->_listeHeros))||$find == false)
            {
                if ($this->_listeHeros[$i]->getId()==$pId)
                {
                    $find = true;
                $hero = $this->_listeHeros[$i];
                }
                $i++;
            }
            return ['found'=>$find,'hero'=>$hero];
        }

    }