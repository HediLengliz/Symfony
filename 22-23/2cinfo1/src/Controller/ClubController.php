<?php

namespace App\Controller;

use App\Repository\ClubRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    #[Route('/club', name: 'app_club')]
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }

    #[Route('/list', name: 'app_formation')]
    public function formations()
    {
        $v1= "2cinfo1";
        $v2= "S14";
        $formations = array(
           array('ref' => 'form147', 'Titre' => 'Formation Symfony
4','Description'=>'formation pratique',
                'date_debut'=>'12/06/2020', 'date_fin'=>'19/06/2020',
                'nb_participants'=>19) ,
            array('ref'=>'form177','Titre'=>'Formation SOA' ,
                'Description'=>'formation
theorique','date_debut'=>'03/12/2020','date_fin'=>'10/12/2020',
                'nb_participants'=>0),
            array('ref'=>'form178','Titre'=>'Formation Angular' ,
                'Description'=>'formation
theorique','date_debut'=>'10/06/2020','date_fin'=>'14/06/2020',
                'nb_participants'=>12));
        return $this->render("club/list.html.twig",array("classe"=>$v1,"salle"=>$v2,"tabFormation"=>$formations));
    }

    #[Route('/reservation', name: 'app_reservation')]

    public function reservation(){
        return $this->render("club/reservation.html.twig");
    }

    #[Route('/clubs', name: 'app_clubs')]
    public function listClub(ClubRepository  $x)
    {
        //$repository=$this->getDoctrine()->getRepository(ClubRepository::class)->findAll();
        $clubs= $x->findAll();
       return $this->render("club/clubs.html.twig",
           array("tabClub"=>$clubs));
    }
}
