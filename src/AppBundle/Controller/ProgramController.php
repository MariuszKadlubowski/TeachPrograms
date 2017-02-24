<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Program controller.
 *
 * @Route("program")
 */
class ProgramController extends Controller
{
    /**
     * Lists all program entities.
     *
     * @Route("/", name="program_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $programs = $em->getRepository('AppBundle:Program')->findAll();

        return $this->render('program/index.html.twig', array(
            'programs' => $programs,
        ));
    }

    /**
     * Creates a new program entity.
     *
     * @Route("/new", name="program_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $program = new Program();
        $form = $this->createForm('AppBundle\Form\ProgramType', $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($program);
            $em->flush($program);

            return $this->redirectToRoute('program_show', array('id' => $program->getId()));
        }

        return $this->render('program/new.html.twig', array(
            'program' => $program,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a program entity.
     *
     * @Route("/{id}", name="program_show")
     * @Method("GET")
     */
    public function showAction(Program $program)
    {
        $deleteForm = $this->createDeleteForm($program);

        return $this->render('program/show.html.twig', array(
            'program' => $program,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing program entity.
     *
     * @Route("/{id}/edit", name="program_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Program $program)
    {
        $deleteForm = $this->createDeleteForm($program);
        $editForm = $this->createForm('AppBundle\Form\ProgramType', $program);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('program_edit', array('id' => $program->getId()));
        }

        return $this->render('program/edit.html.twig', array(
            'program' => $program,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a program entity.
     *
     * @Route("/{id}", name="program_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Program $program)
    {
        $form = $this->createDeleteForm($program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($program);
            $em->flush($program);
        }

        return $this->redirectToRoute('program_index');
    }

    /**
     * Creates a form to delete a program entity.
     *
     * @param Program $program The program entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Program $program)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('program_delete', array('id' => $program->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
