<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Exercise;
use App\Entity\Level;
use App\Entity\Routine;
use App\Form\BuyLevelType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\Collection;


class LevelController extends AbstractController
{
    /**
     * @Route("/level", name="app_level")
     */
    public function index()
    {

        $levels = $this->getDoctrine()->getRepository(Level::class)->findAll();
        return $this->render('level/index.html.twig', [
            'levels' => $levels,

        ]);
    }
    /**
     * @Route("/comprar/{id}/{user}/level", name="buy_level")
     */
    public function buylevel(Request $request, $id,$user)
    {


        $levels = $this->getDoctrine()->getRepository(Level::class)->findBy((array('id' => $id)));
        $users = $this->getDoctrine()->getRepository(User::class)->find($user);
        //create the form
        $form = $this->createForm(BuyLevelType::class, $users);
        $form->handleRequest($request);
        $error = $form->getErrors();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($users);
            $entityManager->flush();
            $em = $this->getDoctrine()->getEntityManager();
            $db = $em->getConnection();
            $query = "UPDATE user
SET level_id = $id
WHERE id = $user;

";
            $stmt = $db->prepare($query);
            $params = array();
            $stmt->execute($params);

            return $this->redirectToRoute('app_perfil');
        }

        return $this->render('level/buylevel.html.twig', [
            'levels' => $levels,
            'form' => $form->createView()



        ]);
    }
    /**
     * @Route("/level/{id}/show", name="level")
     */
    public function showLevel(Request $request, $id)
    {
        $levels = $this->getDoctrine()->getRepository(Routine::class)->findBy(
            array(
                'level'=> $id
            )
        );
        return $this->render('level/levelshow.html.twig', [
            'levels' => $levels


        ]);
    }

    /**
     * @Route("/level/{id}/routine", name="routine_exercises")
     */
    public function showExerciseRoutine(Request $request, $id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $db = $em->getConnection();

        $query = "select exercise.name,exercise.series,exercise.repetitions
FROM routine
INNER JOIN exercise_routine
ON routine.id = exercise_routine.routine_id
INNER JOIN exercise
ON exercise_routine.exercise_id = exercise.id
WHERE routine_id = $id; ";
        $stmt = $db->prepare($query);
        $params = array();
        $stmt->execute($params);
        $levels=$stmt->fetchAll();

        /*$levels = $this->getDoctrine()->getRepository(Exercise::class)->findBy(
            array(
                'routine'=> $id
            ));*/

        return $this->render('level/routines.html.twig', [
            'levels' => $levels

        ]);
    }

    /**
     * @Route("/level/{id}/{user}/addfav", name="addFav")
     */
    public function addFav(Request $request, $id,$user)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $db = $em->getConnection();
        $query2 = "select * FROM user_routine WHERE user_id=$user and routine_id=$id;";

        $query = "INSERT INTO user_routine (user_id, routine_id)
VALUES ($user, $id);";

        $stmt = $db->prepare($query);

        $stmt2 = $db->prepare($query2);

        $stmt2->execute();
        $number_of_rows = $stmt2->fetchColumn();
        $params = array();
        if($number_of_rows>0){


            return $this->redirectToRoute('app_perfil');

        }else{
            $stmt->execute($params);
            return $this->redirectToRoute('app_perfil');
        }





    }

    /**
     * @Route("/level/{id}/{user}/delFav", name="app_del")
     */
    public function delFav(Request $request, $id,$user)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $db = $em->getConnection();
        $query = "DELETE FROM user_routine WHERE user_id='$user' and routine_id='$id';;";

        try {
            $stmt = $db->prepare($query);
            $params = array();
            $stmt->execute($params);
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }




        return $this->redirectToRoute('app_perfil');

    }


}
