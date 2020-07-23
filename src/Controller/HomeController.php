<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Entity\Candidate;
use Symfony\Entity\CandidateFile;
use Symfony\Entity\Client;
use Symfony\Entity\Experience;
use Symfony\Entity\JobOffer;
use Symfony\Entity\JobSector;
use Symfony\Entity\JobType;
use Symfony\Entity\User;



class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        // $campaigns = $this->getDoctrine()
        // ->getRepository(Campaign::class)
        // ->findAll();

        return $this->render('luxury.html.twig', [
            'controller_name' => 'HomeController',
            // 'campaigns' => $campaigns,
        ]);
    }
}
