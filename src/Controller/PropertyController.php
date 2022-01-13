<?php

namespace App\Controller;

use App\Entity\Property;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use App\Form\PropertyType;

class PropertyController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        $repoProperty = $this->em->getRepository(Property::class);
        $propertys = $repoProperty->findAll();
        return $this->render('property/home.html.twig', ['propertys' => $propertys]);
    }


    #[Route('/manage', name: 'app_manage')]
    public function manage(PaginatorInterface $paginator, Request $request): Response
    {
        $repoProperty = $this->em->getRepository(Property::class);
        $propertys = $repoProperty->findAll();
        $pagination = $paginator->paginate(
            $propertys, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );
        return $this->render('property/manage.html.twig', ['propertys' => $pagination]);
    }
        

    #[Route('/show{id<[0-9]+>}', name: 'app_show')]
    public function show(int $id): Response
    {
        $property = $this->em->find(Property::class, $id);
        return $this->render('property/show.html.twig', ['property' => $property]);
    }


    #[Route('/create', name: 'app_create')]
    public function create(Request $request): Response
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $property = $form->getData();
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success','votre nouvelle bien créé avec succès');
            return $this->redirectToRoute('app_home');
        }
        return $this->renderForm('property/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/edit{id<[0-9]+>}', name: 'app_edit')]
    public function edit(Request $request, int $id): Response
    {
        $property = $this->em->find(Property::class, $id);
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $property = $form->getData();
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success','opération de modification effectuée avec succès');
            return $this->redirectToRoute('app_home');
        }
        return $this->renderForm('property/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/Delete{id<[0-9]+>}', name: 'app_delete')]
    public function delete(int $id): Response
    {
        $property = $this->em->find(Property::class, $id);
        $this->em->remove($property);
        $this->em->flush();
        $this->addFlash('success','opération de suppression effectuée avec succès');
        return $this->redirectToRoute('app_manage');
    }
}
