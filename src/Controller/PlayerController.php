<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/players')]
class PlayerController extends AbstractController
{
    #[Route('/create', name: 'app_player_create')]
    public function createPlayer(Request $request, ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        $entityManager = $doctrine->getManager();

        if ($user->getPlayer() !== null) {
            return $this->redirectToRoute('app_home');
        }

        $player = new Player();
        $player->setUser($user);

        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            \dd($player);
            $entityManager->persist($player);
            $entityManager->flush();

            return $this->redirectToRoute('app_player_profile');
        }

        return $this->render('player/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/profil', name: 'app_player_profile')]
    public function profilPlayer(Request $request): Response
    {
        return $this->render('player/profile.html.twig');
    }
}
