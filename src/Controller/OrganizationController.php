<?php

namespace App\Controller;

use App\Entity\Organization;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\OrganizationService;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class OrganizationController extends AbstractController
{
    /**
     * @Route("/organization", name="organization")
     */
    public function index(OrganizationService $organizationService):Response
    {
        $listeOrganizations = $organizationService->getList();
        return $this->render('organization/index.html.twig', [
            'controller_name' => 'OrganizationController',
            'listeOrganizations' => $listeOrganizations
        ]);
    }

    /**
     * @Route("/organization/list", name="liste_organization")
     */
    public function list(OrganizationService $organizationService): Response
    {
        $listeOrganizations =$organizationService->getList();
        return $this->render('organization/list.html.twig',
        [
            'listeOrganizations'=>$listeOrganizations
        ]
        );
    }

    /**
     * @Route("/organization/creer", name="creer_organization")
     */

    public function newOrganization(Request $request, OrganizationService $organizationService):Response
    {
        $organization = new Organization('','');
        $form = $this->createFormBuilder($organization)
            ->add('name',TextType::class)
            ->add('city',TextType::class)
            ->add('save',SubmitType::class, ['label' => 'Creer Organization'])
            ->getForm();
        $request = Request::createFromGlobals();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $organization = $form->getData();
            $organizationService->addOrganization($organization);
            return $this->render('organization/create_completed.html.twig', ['organization' => $organization]);
        } else
            return $this->render('organization/creer.html.twig', ['formulaire' => $form->createView()]);
    }
    /**
     * @Route("organization/{pId}","organization_show")
     */
    public function show($pId, OrganizationService $organizationService): Response
    {
        $organization = $organizationService->getOrganization($pId);
        return $this->render('organization/organization.html.twig', ['organization' =>$organization['organization']]);
    }
    /**
     * @Route("organization/delete/{pId}","organization_delete")
     */
    public function delete($pId, OrganizationService $organizationService): Response
    {
        $organizationService->delOrganization($pId);
        return $this->render('organization/delete_completed.html.twig');
    }
}
