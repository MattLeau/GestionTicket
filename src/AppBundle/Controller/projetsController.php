<?php

namespace AppBundle\Controller;

use AppBundle\Entity\projets;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Projet controller.
 *
 * @Route("projets")
 */
class projetsController extends Controller
{
    /**
     * Lists all projet entities.
     *
     * @Route("/", name="projets_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projets = $em->getRepository('AppBundle:projets')->findAll();

        $chef = $em->getRepository('AppBundle:user')->findBy(['metier' => 'Directeur ']);

        return $this->render('projets/index.html.twig', array(
            'projets' => $projets,'resultat' => $chef
        ));
    }


    /**
     * @Route("/showProjet", name="projet_nom")
     * @method("POST")
     */

    public function showNomProjetAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getRepository(projets::class)
        ;
        $projet = $repository->findBy( ['chef'=> $_POST['choixChef']]);
        return $this->render('projets/showProjet.html.twig', array('proj' => $projet));
    }




    /**
     * Creates a new projet entity.
     *
     * @Route("/new", name="projets_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $projet = new projets();
        $form = $this->createForm('AppBundle\Form\projetsType', $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($projet);
            $em->flush();

            return $this->redirectToRoute('projets_show', array('id' => $projet->getId()));
        }

        return $this->render('projets/new.html.twig', array(
            'projet' => $projet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projet entity.
     *
     * @Route("/{id}", name="projets_show")
     * @Method("GET")
     */
    public function showAction(projets $projet)
    {
        $deleteForm = $this->createDeleteForm($projet);

        return $this->render('projets/show.html.twig', array(
            'projet' => $projet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projet entity.
     *
     * @Route("/{id}/edit", name="projets_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, projets $projet)
    {
        $deleteForm = $this->createDeleteForm($projet);
        $editForm = $this->createForm('AppBundle\Form\projetsType', $projet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('projets_edit', array('id' => $projet->getId()));
        }

        return $this->render('projets/edit.html.twig', array(
            'projet' => $projet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projet entity.
     *
     * @Route("/{id}/delete", name="projets_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, projets $projet)
    {
        $form = $this->createDeleteForm($projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projet);
            $em->flush();
        }

        return $this->redirectToRoute('projets_index');
    }

    /**
     * Creates a form to delete a projet entity.
     *
     * @param projets $projet The projet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(projets $projet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projets_delete', array('id' => $projet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
