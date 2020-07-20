<?php

namespace App\Controller;

use App\Entity\CandidateFile;
use App\Form\CandidateFileType;
use App\Repository\CandidateFileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @Route("/candidatefile")
 */
class CandidateFileController extends AbstractController
{
    /**
     * @Route("/", name="candidate_file_index", methods={"GET"})
     */
    public function index(CandidateFileRepository $candidateFileRepository): Response
    {
        return $this->render('candidate_file/index.html.twig', [
            'candidate_files' => $candidateFileRepository->findAll(),
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
     * @Route("/new", name="candidate_file_new", methods={"GET","POST"})
     */
    public function new(Request $request,  SluggerInterface $slugger): Response
    {
        $candidateFile = new CandidateFile();
        $form = $this->createForm(CandidateFileType::class, $candidateFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            /** @var UploadedFile $file */
            $file = $form->get('files')->getData();
            if ($file){
                $newFilename = $this->saveUploadFile(
                    $file, 
                    $this->getParameter('pictures_directory'),
                    $slugger
                );
                $candidateFile->setFiles($newFilename);
            }

           

           

            $entityManager->persist($candidateFile);
            $entityManager->flush();

            return $this->redirectToRoute('candidate_file_index');
        }

        return $this->render('candidate_file/new.html.twig', [
            'candidate_file' => $candidateFile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="candidate_file_show", methods={"GET"})
     */
    public function show(CandidateFile $candidateFile): Response
    {
        return $this->render('candidate_file/show.html.twig', [
            'candidate_file' => $candidateFile,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="candidate_file_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CandidateFile $candidateFile): Response
    {
        $form = $this->createForm(CandidateFileType::class, $candidateFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('candidate_file_index');
        }

        return $this->render('candidate_file/edit.html.twig', [
            'candidate_file' => $candidateFile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="candidate_file_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CandidateFile $candidateFile): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidateFile->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($candidateFile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('candidate_file_index');
    }
}
