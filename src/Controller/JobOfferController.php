<?php

namespace App\Controller;

use App\Entity\JobOffer;
use App\Entity\JobSector;
use App\Entity\Candidate;
use App\Form\JobOfferType;
use App\Repository\JobOfferRepository;
use App\Repository\JobSectorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/job/offer")
 */
class JobOfferController extends AbstractController
{
    /**
     * @Route("/list", name="job_offer_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(JobOfferRepository $jobOfferRepository): Response
    {
        return $this->render('job_offer/index.html.twig', [
            'job_offers' => $jobOfferRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", name="jobOffers", methods={"GET"})
     */
    public function jobOffers(JobOfferRepository $jobOfferRepository, JobSectorRepository $jobsectorRepository): Response
    {   
        
        $user =  $this->getUser();  
        //redirect anonymous to login form.
        if (!($user instanceof UserInterface)){       
            return $this->redirectToRoute('app_login');      
        }

        $candidate = $user->getCandidate();

        
        $jobOffers = $jobOfferRepository->findBy([],null,20,null);
        $jobSectors = $jobsectorRepository->findAll();
        
        dump($jobOffers);

        foreach($jobOffers as $jobOffer)
        {
            $candidate->addJobApplication($jobOffer);
        }
        
        dump($candidate);
        $applications = [];
        if ($candidate instanceof Candidate){
            $applications = $candidate->getJobApplication();
        }
       

        // $applications = $candidate->getJobApplication()use App\Entity\JobSector;
        
        return $this->render('job_offer/job_offer.html.twig', [
            'job_offers' => $jobOffers,
            'job_sectors' => $jobSectors,
            'applications' => $applications,

        ]);
    }

    /**
     * @Route("/new", name="job_offer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $jobOffer = new JobOffer();
        $form = $this->createForm(JobOfferType::class, $jobOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jobOffer);
            $entityManager->flush();

            return $this->redirectToRoute('job_offer_index');
        }

        return $this->render('job_offer/new.html.twig', [
            'job_offer' => $jobOffer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_offer_show", methods={"GET"})
     */
    public function show(JobOffer $jobOffer): Response
    {
        return $this->render('job_offer/show.html.twig', [
            'job_offer' => $jobOffer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="job_offer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, JobOffer $jobOffer): Response
    {
        $form = $this->createForm(JobOfferType::class, $jobOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('job_offer_index');
        }

        return $this->render('job_offer/edit.html.twig', [
            'job_offer' => $jobOffer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_offer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, JobOffer $jobOffer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobOffer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($jobOffer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('job_offer_index');
    }
}
