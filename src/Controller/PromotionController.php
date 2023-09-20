<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
use App\Repository\PromotionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionController extends AbstractController
{
    #[Route('/promotion', name: 'app_promotion_list')]
    public function listPromotion(PromotionRepository $promotionRepository): Response
    {
        $promotions = $promotionRepository->findAll();
        return $this->render('promotion/index.html.twig', [
            'promotions' => $promotions,
        ]);
    }

    #[Route('/promotion/{id}', name: 'app_promotion_detail')]
    public function detail(PromotionRepository $promotionRepository,EtudiantRepository $etudiantRepository,$id): Response
    {
        $promotion = $promotionRepository->findOneBy(["id"=>$id]);
        $etudiants = $promotion->getEtudiants();
        $nbrEtudiants = count($etudiants);
        return $this->render('promotion/details_promotion.html.twig', [
            'promotion' => $promotion,
            'etudiants' => $etudiants,
            'nombreEtudiants' => $nbrEtudiants,
        ]);
    }
}
