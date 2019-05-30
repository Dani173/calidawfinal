<?php

namespace App\Controller;


use App\Entity\Exercise;
use App\Form\MuscleFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Musclegroups;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class MuscleController extends AbstractController
{
    /**
     * @Route("/muscle", name="muscle")
     */
    public function index()
    {
        $musclegroups = $this->getDoctrine()->getRepository(Musclegroups::class)->findAll();

        return $this->render('muscle/index.html.twig', [
            'musclegroup' => $musclegroups,
        ]);
    }
    /**
     * @Route("/muscle/{id}/show", name="exercisemuscle")
     */
    public function showExercisesbyMuscle(Request $request, $id)
    {

        $exercises = $this->getDoctrine()->getRepository(Exercise::class)->findBy(
            array(
                'muscle'=> $id
            )
        );



        return $this->render('muscle/exercisemuscle.html.twig', [
            'exercises' => $exercises


        ]);
    }
    /**
     * @Route("/muscle/form", name="form_ase")
     */
    public function formAse(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $db = $em->getConnection();
        $query = "select musclegroups.name
FROM musclegroups;
 ";
          $stmt = $db->prepare($query);
        $params = array();
        $stmt->execute($params);
        $levels=$stmt->fetchAll();

        $em2 = $this->getDoctrine()->getEntityManager();
        $db2 = $em2->getConnection();
        $query2 = "select name
FROM level;
 ";
        $stmt2 = $db2->prepare($query2);
        $params2 = array();
        $stmt2->execute($params2);
        $levels2=$stmt2->fetchAll();


        // creates a task and gives it some dummy data for this example


        $form = $this->createFormBuilder()
            ->add('task', TextType::class)
            ->add('isAttending', ChoiceType::class, [
                'choices'  => [
                    'Maybe' => $levels2[0],
                ],
            ])

            ->getForm();


        return $this->render('muscle/ase.html.twig', [
            'levels' => $levels,
            'levels2' => $levels2,
            'form' => $form->createView()

        ]);
    }
    /**
     * @Route("/muscle/filtro", name="app_filtr")
     */
    public function filtr(Request $request)
    {
        $data = $request->getData('carlist');


       return $this->render('muscle/filtro.html.twig', [
            'select1' => $data


        ]);
    }

}
