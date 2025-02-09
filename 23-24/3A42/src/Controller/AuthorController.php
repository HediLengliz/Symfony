<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/showauthor/{username}', name: 'show_author')]
    public function showAuthor($username)
    {
        return $this->render("author/show.html.twig"
            ,array('nameAuthor'=>$username));
    }

    #[Route('/list', name: 'list_author')]
    public function listAuthors()
    {
        $authors = array(
            array('id' => 1, 'username' => ' Victor Hugo','email'=> 'victor.hugo@gmail.com', 'nb_books'=> 100),
            array ('id' => 2, 'username' => 'William Shakespeare','email'=>
                'william.shakespeare@gmail.com','nb_books' => 200),
            array('id' => 3, 'username' => ' Taha Hussein','email'=> 'taha.hussein@gmail.com','nb_books' => 300),
        );
        return $this->render("author/list.html.twig",
            array('tabAuthors'=>$authors));
    }

    #[Route('/listAuthor', name: 'list_authors')]
    public function list(AuthorRepository $repository)
    {
        $authors= $repository->findAll();

        return $this->render("author/authors.html.twig",
            array('tabAuthors'=>$authors));
    }

    #[Route('/addAuthor', name: 'addAuthor')]
    public function addAuthor(Request $request,ManagerRegistry $managerRegistry)
    {
       $author= new Author();
       $form= $this->createForm(AuthorType::class,$author);
       $form->handleRequest($request);
       if($form->isSubmitted()){
        $em= $managerRegistry->getManager();
        $em->persist($author);
       $em->flush();
       return $this->redirectToRoute("list_authors");
       }
//       $author->setEmail("author4@gmail.com");
//       $author->setUsername("author4");
       #$em= $this->getDoctrine()->getManager();
//        $em= $managerRegistry->getManager();
//        $em->persist($author);
//        $em->flush();
//        return $this->redirectToRoute("list_authors");
        //1ère méthode
//        return $this->render("author/add.html.twig"
//            ,array('formulaireAuthor'=>$form->createView()));
        //2ème méthode
        return $this->renderForm("author/add.html.twig"
            ,array('formulaireAuthor'=>$form));
    }

    #[Route('/update/{id}', name: 'updateAuthor')]
    public function updateAuthor($id,AuthorRepository $repository,ManagerRegistry $managerRegistry)
    {
        $author= $repository->find($id);
        $author->setEmail("author5@gmail.com");
        $author->setUsername("author5");
        #$em= $this->getDoctrine()->getManager();
        $em= $managerRegistry->getManager();
        $em->flush();
        return $this->redirectToRoute("list_authors");
    }

    #[Route('/remove/{id}', name: 'remove')]

    public function deleteAuthor(ManagerRegistry $managerRegistry,$id,AuthorRepository $repository)
    {
        $author= $repository->find($id);
        $em= $managerRegistry->getManager();
        $em->remove($author);
        $em->flush();
        return $this->redirectToRoute("list_authors");

    }
}
