<?php
namespace App\Services;

use App\Entity\Organization;
use Doctrine\ORM\EntityManagerInterface;

class OrganizationService
{
    private $_entityManager;
    private $_listeOrganizations = [];
    
    public function getList()
    {
       
        return $this->_listeOrganizations;
    }

    function __construct(EntityManagerInterface $em)
    {
        $this->_entityManager=$em;
        $this->addOrganization(new Organization('Harley','Gotham City'));
        $this->addOrganization(new Organization('Brice','New York'));
        $this->addOrganization(new Organization('Clark','Metropolis'));
        $this->addOrganization(new Organization('Diana','Calfornie'));
    }

    function addOrganization($pOrganization)
    {
        array_push($this->_listeOrganizations,$pOrganization);
        $this->_entityManager->persist($pOrganization);
            $this->_entityManager->flush();
    }
        public function getOrganization($pId)
        {
            $find = false;
            $organization = null;
            $i = 0; 
            while (($i < count($this->_listeOrganizations))||$find == false)
            {
                if ($this->_listeOrganizations[$i]->getId()==$pId)
                {
                    $find = true;
                $organization = $this->_listeOrganizations[$i];
                }
                $i++;
            }
            return ['found'=>$find,'organization'=>$organization];
        }
    }
