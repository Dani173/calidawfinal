<?php
/**
 * Created by PhpStorm.
 * User: linux
 * Date: 23/01/19
 * Time: 17:55
 */
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

Class HomeController extends AbstractController
{
    /**
     * @Route ("/", name="app_homepage")
     */
    public function homepage(){
        return $this->render('home/home.html.twig');
    }

    /**
     * @Route ("/contacto", name="contacto")
     */
    public function contacto(){
        return $this->render('home/contacto.html.twig');
    }
}