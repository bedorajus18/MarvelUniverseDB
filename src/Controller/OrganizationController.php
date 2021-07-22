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
     * @Route("/organization/list", name="liste_organization")
     */
    public function list(OrganizationService $OrganizationService): Response
    {
        $listeOrganizations =$OrganizationService->getList();
        return $this->render('organization/list.html.twig',
        ['listeOrganizations'=>$listeOrganizations] );
    }
}
