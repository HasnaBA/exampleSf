<?php

namespace App\Controller\Api;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Entity\Game;



class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     */
    public function index()
    {
        $games = $this->getDoctrine()
        ->getRepository(Game::class)
        ->findAll();

        $response = [];

        foreach($games as $game) {
            $response[] = [
                'id' => $game->getId(),
                'name' => preg_replace('/\s+/', ' ', str_replace("\n", '', $game->getName())),

            ];
        }


        return $this->json($response);
    }


    /**
     * @Route("/game/{id}", 
     *      name="game_detail",
     *      requirements={"id"="\d+"}
     * )
     */
    public function game($id)
    {
        $game = $this->getDoctrine()
        ->getRepository(Game::class)
        ->find($id);

        if (!$game) {
            throw $this->createNotFoundException('Game does not exist');

        }

       

        $editor = $game->getEditor();
            $editors[] = [
                'id' => $editor->getId(),
                'name' => $editor->getName(),
            ];
       
            
            $response[] = [
                'id' => $game->getId(),
                'name' => $game->getName(),
                'editor' => $editors,

            ];
        return $this->json($response);
    }
 
}

