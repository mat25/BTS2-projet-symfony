<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class EtudiantController extends AbstractController
{
    #[Route('/etudiants', name: 'app_etudiant_list')]
    public function list(EtudiantRepository $etudiantRepository): Response
    {
        // Appel au modele
        // Le controller va demander au modele la liste des étudiants
        $etudiants = $etudiantRepository->findAll();

        // Appel a la vue
        return $this->render('etudiant/index.html.twig', [
            'etudiants' => $etudiants,
        ]);
    }

    #[Route('/etudiants/{id_etudiant}', name: 'app_etudiant_details',requirements: ['id_etudiant'=> '\d+'])]
    public function details(EtudiantRepository $etudiantRepository,int $id_etudiant): Response
    {
        $etudiant = $etudiantRepository->find($id_etudiant);

        return $this->render('etudiant/detail_etudiant.html.twig', [
            'etudiant' => $etudiant,
        ]);
    }
    #[Route('/etudiants/mineurs', name: 'app_etudiant_mineurs_list')]
    public function listMineurs(EtudiantRepository $etudiantRepository): Response
    {

        $etudiants = $etudiantRepository->findMineurs2();

        return $this->render('etudiant/index.html.twig', [
            'etudiants' => $etudiants,
        ]);
    }

}
