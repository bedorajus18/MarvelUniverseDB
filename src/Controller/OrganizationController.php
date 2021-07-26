<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\OrganizationService;

class OrganizationController extends AbstractController
{
    /**
     * @Route("/organization", name="organization")
     */
    public function index(OrganizationService $OrganizationService): Response
    {
        $listeOrganizations=$OrganizationService->getList();
        return $this->render('organization/index.html.twig', [
            'controller_name' => 'OrganizationController',
            'listeOrganizations'=>$listeOrganizations
        ]);
    }
    
    /**
     * @Route("/organization/creer", name="creer_organization")
     */
   
    public function newOrganization():Response
    {
        return $this->render('organization/creer.html.twig',[]);
    }
}
