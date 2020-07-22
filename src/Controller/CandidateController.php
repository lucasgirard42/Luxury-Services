<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\User;
use App\Form\CandidateType;
use App\Repository\CandidateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/candidate")
 */
class CandidateController extends AbstractController
{
    /**
     * @Route("/list", name="candidate_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(CandidateRepository $candidateRepository): Response
    {   

        return $this->render('candidate/index.html.twig', [
            'candidates' => $candidateRepository->findAll(),
        ]);
    }
    
    /**
     * 
     */
    private function saveUploadFile(UploadedFile $file, string $directory, SluggerInterface $slugger)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
               
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move(
                $directory,
                $newFilename
            );
        } catch (FileException $e) {
            $newFilename = 'error file upload';
        }

        return $newFilename;
    }


    /**
     * @Route("/new", name="candidate_new", methods={"GET","POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {   
        $user = $this->getUser();
        if ($user->getCandidate() instanceof Candidate){
             $candidateId=$user->getCandidate()->getId();
            return $this->redirectToRoute('candidate_edit',[
                'id'=> $candidateId
            ]);
        }
        
        $candidate = new Candidate();
        $form = $this->createForm(CandidateType::class, $candidate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            

            $candidate->setUser($user);


            /** @var UploadedFile $file */
            $file = $form->get('profilPicture')->getData();
            if ($file){
                $newFilename = $this->saveUploadFile(
                    $file, 
                    $this->getParameter('pictures_directory'),
                    $slugger
                );
                $candidate->setProfilPicture($newFilename);
            }

            $file = $form->get('cv')->getData();
            if ($file){
                $newFilename = $this->saveUploadFile(
                    $file, 
                    $this->getParameter('pictures_directory'),
                    $slugger
                );
                
                $candidate->setCv($newFilename);
            }

            $entityManager->persist($candidate);
            $entityManager->flush();

            return $this->redirectToRoute('candidate_show_user');
        }

        return $this->render('candidate/new.html.twig', [
            'candidate' => $candidate,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/", name="candidate_show_user", methods={"GET"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
   public function showUser(): Response         //faire une fontion show>USer
    {   
        /** @var User $user */
        $user = $this->getUser();

        $candidate = $user->getCandidate();
        if (!isset($candidate))
        {
            return $this->redirectToRoute('candidate_new');
        }


        return $this->render('candidate/show.html.twig', [
            'candidate' => $candidate,
        ]);
    }
    /**
     * @Route("/{id}", name="candidate_show", methods={"GET"})
     */
    public function show(Candidate $candidate): Response
    {   
        return $this->render('candidate/show.html.twig', [
            'candidate' => $candidate,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="candidate_edit", methods={"GET","POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function edit(Request $request, Candidate $candidate): Response
    {
        $form = $this->createForm(CandidateType::class, $candidate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirectToRoute('candidate_index');
        }

        return $this->render('candidate/edit.html.twig', [
            'candidate' => $candidate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="candidate_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Candidate $candidate): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($candidate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('candidate_index');
    }
}
