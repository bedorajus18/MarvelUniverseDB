<?php

namespace App\Services;

use App\Entity\Organization;
use Doctrine\ORM\EntityManagerInterface;

class OrganizationService
{
    private $_entityManager;
    private $_listeOrganizations = [];

    public function __construct(EntityManagerInterface $em)
    {
        $this->_entityManager = $em;
        $this->_listeOrganizations = $this->_entityManager->getRepository(Organization::class)->findAll();
    }

    public function getList()
    {
       return $this->_listeOrganizations;
    }

    function addOrganization($pOrganization)
    {
        array_push($this->_listeOrganizations, $pOrganization);
        $this->_entityManager->persist($pOrganization);
        $this->_entityManager->flush();
    }

    public function getOrganization($pId)
    {
        $find = false;
        $organization = $this->_entityManager->getRepository(Organization::class)->find($pId);
        if (isset($organization))
            $find = true;
        return  ['found'=>$find,'organization'=>$organization];
    }

    public function delOrganization($pId)
    {
        $organization = $this->getOrganization($pId);
        if ($organization['found']== true)
        {
            $this->_entityManager->remove($organization['hero']);
            $this->_entityManager->flush();
        }
        
    }
}
