<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ChosenProgram;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Chosenprogram controller.
 *
 * @Route("chosenprogram")
 */
class ChosenProgramController extends Controller
{
    /**
     * Lists all chosenProgram entities.
     *
     * @Route("/", name="chosenprogram_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $chosenPrograms = $em->getRepository('AppBundle:ChosenProgram')->findAll();

        return $this->render('chosenprogram/index.html.twig', array(
            'chosenPrograms' => $chosenPrograms,
        ));
    }

    /**
     * Creates a new chosenProgram entity.
     *
     * @Route("/new", name="chosenprogram_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $chosenProgram = new Chosenprogram();
        $form = $this->createForm('AppBundle\Form\ChosenProgramType', $chosenProgram);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chosenProgram);
            $em->flush($chosenProgram);

            return $this->redirectToRoute('chosenprogram_show', array('id' => $chosenProgram->getId()));
        }

        return $this->render('chosenprogram/new.html.twig', array(
            'chosenProgram' => $chosenProgram,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a chosenProgram entity.
     *
     * @Route("/{id}", name="chosenprogram_show")
     * @Method("GET")
     */
    public function showAction(ChosenProgram $chosenProgram)
    {
        $deleteForm = $this->createDeleteForm($chosenProgram);

        return $this->render('chosenprogram/show.html.twig', array(
            'chosenProgram' => $chosenProgram,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing chosenProgram entity.
     *
     * @Route("/{id}/edit", name="chosenprogram_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ChosenProgram $chosenProgram)
    {
        $deleteForm = $this->createDeleteForm($chosenProgram);
        $editForm = $this->createForm('AppBundle\Form\ChosenProgramType', $chosenProgram);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chosenprogram_edit', array('id' => $chosenProgram->getId()));
        }

        return $this->render('chosenprogram/edit.html.twig', array(
            'chosenProgram' => $chosenProgram,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a chosenProgram entity.
     *
     * @Route("/{id}", name="chosenprogram_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ChosenProgram $chosenProgram)
    {
        $form = $this->createDeleteForm($chosenProgram);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($chosenProgram);
            $em->flush($chosenProgram);
        }

        return $this->redirectToRoute('chosenprogram_index');
    }

    /**
     * Creates a form to delete a chosenProgram entity.
     *
     * @param ChosenProgram $chosenProgram The chosenProgram entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ChosenProgram $chosenProgram)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('chosenprogram_delete', array('id' => $chosenProgram->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
