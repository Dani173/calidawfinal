<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserEditType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
class PerfilController extends AbstractController
{
    /**
     * @Route("/perfil", name="app_perfil")
     */
    public function index()
    {

        return $this->render('perfil/index.html.twig', [
            'controller_name' => 'PerfilController',
        ]);
    }

    /**
     * @Route("/perfil/{id}/edit", name="app_perfil_cambiar")
     */
    public function cambiarPerfil(Request $request, $id)
    {
        $title="Edit";
        $post = $this->getDoctrine()->getRepository(User::class)->find($id);
        //create the form
        $form = $this->createForm(UserEditType::class, $post);
        $form->handleRequest($request);
        $error = $form->getErrors();
        if ($form->isSubmitted() && $form->isValid()) {
            //handle the entities
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
            $this->addFlash(
                'succes', 'Perfil edited'
            );
            return $this->redirectToRoute('app_perfil');
        }
        return $this->render('perfil/formedit.html.twig', [
            'error' => $error,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/perfil/{id}/show", name="app_mostrar_fav")
     */
    public function mostrarFav(Request $request, $id)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $db = $em->getConnection();

        $query = "select routine.id, routine.name
FROM user
INNER JOIN user_routine
ON user.id = user_routine.user_id
INNER JOIN routine
ON user_routine.routine_id = routine.id
WHERE user_routine.user_id = $id; ";
        $stmt = $db->prepare($query);
        $params = array();
        $stmt->execute($params);
        $levels=$stmt->fetchAll();

        return $this->render('perfil/mostrarfav.html.twig', [
            'levels' => $levels,


        ]);
    }
}
