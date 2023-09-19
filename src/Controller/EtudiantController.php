<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    #[Route('/etudiants/{id_etudiant}', name: 'app_etudiant_details')]
    public function details(EtudiantRepository $etudiantRepository,int $id_etudiant): Response
    {
        $etudiant = $etudiantRepository->find($id_etudiant);

        return $this->render('etudiant/detail_etudiant.html.twig', [
            'etudiant' => $etudiant,
        ]);
    }
}
