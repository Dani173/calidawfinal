<?php

namespace App\Controller;

use App\Entity\Challenges;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Routine;

class RetosController extends AbstractController
{
    /**
     * @Route("/retos", name="retos")
     */
    public function index()
    {
        $challenges = $this->getDoctrine()->getRepository(Challenges::class)->findAll();

        return $this->render('retos/index.html.twig', [
            'levels' => $challenges,
        ]);
    }
    /**
     * @Route("/retos/{id}/show", name="reto_show")
     */
    public function showRetos(Request $request, $id)
    {
        $levels = $this->getDoctrine()->getRepository(Routine::class)->findBy(
            array(
                'level'=> $id
            )
        );
        return $this->render('retos/showret.html.twig', [
            'levels' => $levels


        ]);
    }

}
