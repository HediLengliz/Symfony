<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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


    #[Route('/showauthor/{var}', name: 'show_author')]
    public function showAuthor($var)
    {
        return $this->render("author/show.html.twig"
            ,array('nameAuthor'=>$var));
    }

    #[Route('/listAuthors', name: 'list_author')]
    public function listAuthors()
    {
        $authors = array(
            array ('id' => 2, 'username' => 'William Shakespeare','email'=>
                'william.shakespeare@gmail.com','nb_books' => 200),
            array('id' => 3, 'username' => ' Taha Hussein','email'=> 'taha.hussein@gmail.com','nb_books' => 300),
        );
        return $this->render("author/list.html.twig",
            array("tabAuthors"=>$authors));
    }

}
