<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Candidate;
use App\Entity\CandidateFile;
use App\Entity\Client;
use App\Entity\Experience;
use App\Entity\JobOffer;
use App\Entity\JobSector;
use App\Entity\JobType;
use App\Entity\User;
use App\Repository\JobOfferRepository;
use App\Repository\JobSectorRepository;




class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(JobOfferRepository $jobOfferRepository, JobSectorRepository $jobsectorRepository): Response
    {
        $jobOffers = $jobOfferRepository->findBy(['activity'=> true],null,20,null);
        $jobSectors = $jobsectorRepository->findAll();
        
       


        
       

       

        return $this->render('luxury.html.twig', [
            'controller_name' => 'HomeController',
            'job_sectors' => $jobSectors,
            'job_offers' => $jobOffers,
            
        ]);
    }

    /**
     * @Route("/about/us", name="about_us")
     */

    public function aboutUs()
    {
        return $this->render('home/about_us.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('home/contact.html.twig');
    }


}
