<?php

namespace App\Controller;

use App\Services\HeroService;
use App\Entity\Hero;
use App\Form\HeroType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HeroController extends AbstractController
{
    /**
     * @Route("/hero", name="hero")
     */
    public function index(): Response
    {
        return $this->render('hero/index.html.twig', [
            'controller_name' => 'HeroController',
        ]);
    }
    /**
     * @Route("/hero/list", name="liste_hero")
     */
    public function list(HeroService $heroService): Response
    {
        $listeHeros =$heroService->getList();
        return $this->render('hero/list.html.twig',
        [
            'heroList'=>$listeHeros
        ]
        );
    }
    /**
     * @Route("hero/create","hero_creation")
     */
    public function newHero(Request $request,HeroService $heroService):Response
    {

        $hero = new Hero('','',false,'','','');
        $form = $this->createForm(HeroType::class,$hero);
       /* $form = $this->createFormBuilder($hero)
        ->add('firstname',TextType::class)
        ->add('name',TextType::class)
        ->add('pseudo',TextType::class)
        ->add('save', SubmitType::class, ['label' => 'Créer Hero'])
            ->getForm();*/
        $request = Request::createFromGlobals();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $hero = $form->getData();
            $heroService->addHero($hero);
            return $this->render('hero/create_completed.html.twig',['hero'=>$hero]);
        }
        else
        return $this->render('hero/creer.html.twig',['formulaire'=>$form->createView()]);
    }
/**
 * @Route("hero/{pId}","hero_show")
 */

    public function show($pId, HeroService $heroService):Response
    {
        $hero = $heroService->getHero($pId);
        return $this->render('hero/hero.html.twig',['hero'=>$hero['hero']]);
    }

    /**
     * @Route("hero/delete/{pId}","hero_delete")
     */
    public function delete($pId, HeroService $heroService):Response
    {
        $heroService->delHero($pId);
        return $this->render('hero/delete_completed.html.twig');
    }

    public function new(): Response
        {
        // just setup a fresh $task object (remove the example data)
        $hero = new Hero('','','',false,'','');
        $form = $this->createForm(heroType::class, $hero);
        $request = Request::createFromGlobals();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $hero = $form->getData();

            // ... perform some action, such as saving the task to the database
            // $entityManager->flush();
            return $this->redirectToRoute('hero_success');
        }
        else
        {
            return $this->render('hero/creer.html.twig', 
            ['form' => $form->createView()]);
        }
    }
}