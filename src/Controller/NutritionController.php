<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NutritionController extends AbstractController
{
    /**
     * @Route("/nutrition", name="nutrition")
     */
    public function index()
    {
        return $this->render('nutrition/index.html.twig', [
            'controller_name' => 'NutritionController',
        ]);
    }

    /**
     * @Route("/nutrition/fibra", name="fibra")
     */
    public function fibra()
    {
        return $this->render('nutrition/fibra.html.twig', [
            'controller_name' => 'NutritionController',
        ]);
    }

    /**
     * @Route("/nutrition/ayuno", name="ayuno")
     */
    public function ayuno()
    {
        return $this->render('nutrition/ayuno.html.twig', [
            'controller_name' => 'NutritionController',
        ]);
    }

    /**
     * @Route("/nutrition/prepost", name="prepost")
     */
    public function prepost()
    {
        return $this->render('nutrition/prepost.html.twig', [
            'controller_name' => 'NutritionController',
        ]);
    }

    /**
     * @Route("/nutrition/calorias", name="calorias")
     */
    public function calorias()
    {
        return $this->render('nutrition/calorias.html.twig', [
            'controller_name' => 'NutritionController',
        ]);
    }

    /**
     * @Route("/nutrition/agua", name="agua")
     */
    public function agua()
    {
        return $this->render('nutrition/agua.html.twig', [
            'controller_name' => 'NutritionController',
        ]);
    }

    /**
     * @Route("/nutrition/alcohol", name="alcohol")
     */
    public function alcohol()
    {
        return $this->render('nutrition/alcohol.html.twig', [
            'controller_name' => 'NutritionController',
        ]);
    }
}
