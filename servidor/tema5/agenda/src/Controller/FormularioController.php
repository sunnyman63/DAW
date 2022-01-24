<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tarea;
use App\Entity\Categoria;
use App\Form\FormularioTareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityManagerInterface;

class FormularioController extends AbstractController
{
    /**
     * @Route("/formulario", name="app_formulario")
     */
    public function formuSimple(): Response{

        $tarea = new Tarea();
        $tarea->setNombre("");
        $tarea->setFechaRealizacion(new \DateTime());
        
        $form = $this->createFormBuilder($tarea)
        ->add('nombre', TextType::class)
        ->add('fechaRealizacion', DateTimeType::class)
        ->add('categoria', EntityType::class, array(
            'class'=>Categoria::class,
            'choice_label'=>'nombre'
        ))
        ->add('guardar', SubmitType::class, array('label'=>'crear tarea'))
        ->getForm();


        
        return $this->render('formulario/index.html.twig', [
            'controller_name' => 'FormularioController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/insertarFormulario", name="app_insertarFormulario")
     */
    public function insertarFormu(Request $request,EntityManagerInterface $em): Response{
        $tarea = new Tarea();
        $tarea->setNombre("hacer ejercicios de PHP");
        $tarea->setFechaRealizacion(new \DateTime(("tomorrow")));
        
        $form = $this->createFormBuilder($tarea)
        ->add('nombre', TextType::class)
        ->add('fechaRealizacion', DateTimeType::class)
        ->add('categoria', EntityType::class, array(
            'class'=>Categoria::class,
            'choice_label'=>'nombre'
        ))
        ->add('guardar', SubmitType::class, array('label'=>'crear tarea'))
        ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $tarea = $form->getData();
            $em->persist($tarea);
            $em->flush();
            return $this->redirectToRoute('app_formulario');
        }

        return $this->render('formulario/index.html.twig', [
            'controller_name' => 'FormularioController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/modificarFormulario", name="app_modificarFormulario")
     */
    public function modificar(Request $request, EntityManagerInterface $em) {
        $id = 1;
        $tarea = $em->getRepository(Tarea::class)->find($id);
        $form = $this->createForm(FormularioTareaType::class,$tarea);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $tarea = $form->getData();
            $em->persist($tarea);
            $em->flush();
            return $this->redirectToRoute('app_formulario');
        }

        return $this->render('formulario/index.html.twig', [
            'controller_name' => 'FormularioController',
            'form' => $form->createView(),
        ]);
    }


}
