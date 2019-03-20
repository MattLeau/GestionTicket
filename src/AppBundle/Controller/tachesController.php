<?php

namespace AppBundle\Controller;

use AppBundle\Entity\taches;
use AppBundle\Entity\user;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tache controller.
 *
 * @Route("taches")
 */
class tachesController extends Controller
{
    /**
     * Lists all taches entities.
     *
     * @Route("/", name="taches_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $taches = $em->getRepository('AppBundle:taches')->findAll();

        return $this->render('taches/index.html.twig', array(
            'taches' => $taches,
        ));
    }

    /**
     * @Route("/showTacheProjet", name="taches_tachesProjet")
     * @method("POST")
     */

    public function showTachesProjetAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getRepository(taches::class)
        ;
        $resultat = $repository->findBy( ["evolution" => $_POST['projet']]);
        print_r($resultat);
        return $this->render('taches/showTachesProjet.html.twig', array('taches' => $resultat));
    }

    /**
     * @Route("/statsTaches", name="taches_stats")
     * @method("POST")
     */

    public function StatsTachesAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository(taches::class);

        $query = $repository->createQueryBuilder('p')
            ->select('count(p), p.evolution')
            ->groupBy('p.evolution')
            ->getQuery();

        #$products = $query->setMaxResults(1)->getOneOrNullResult();
        $products = $query->execute();
        print_r($products);
        return $this->render('taches/showStatsTaches.html.twig',array('resultat' => $products));


        /*
        $qb = $em->createQueryBuilder();

        $qb->select('u')
            ->from('user', 'u')
            ->where('u.id = 1');

        return $this->render('taches/showStatsTaches.html.twig',array('tab' => $qb));
    */
        /*
                $repository = $this
                    ->getDoctrine()
                    ->getRepository(user::class)
                ;
                $resultat =  $repository->createQueryBuilder('u')
                    ->select('count(u.id)')
                    ->getQuery()
                    ->getSingleScalarResult();
                return $this->render('taches/showStatsTaches.html.twig',array('tab' => $resultat));
        */
        /*
        ->where('u.nom = :MESNAGE-1')
        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = 'SELECT * FROM user;';

        $statement = $em->getConnection()->preprare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();

        return $this->render('taches/showStatsTaches.html.twig',array('tab' => $result));
        */
    }




    /**
     * Creates a new taches entity.
     *
     * @Route("/new", name="taches_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tach = new taches();
        $form = $this->createForm('AppBundle\Form\tachesType', $tach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tach);
            $em->flush();

            return $this->redirectToRoute('taches_show', array('id' => $tach->getId()));
        }

        return $this->render('taches/new.html.twig', array(
            'tach' => $tach,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tach entity.
     *
     * @Route("/{id}", name="taches_show")
     * @Method("GET")
     */
    public function showAction(taches $tach)
    {
        $deleteForm = $this->createDeleteForm($tach);

        return $this->render('taches/show.html.twig', array(
            'tach' => $tach,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tach entity.
     *
     * @Route("/{id}/edit", name="taches_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, taches $tach)
    {
        $deleteForm = $this->createDeleteForm($tach);
        $editForm = $this->createForm('AppBundle\Form\tachesType', $tach);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('taches_edit', array('id' => $tach->getId()));
        }

        return $this->render('taches/edit.html.twig', array(
            'tach' => $tach,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tach entity.
     *
     * @Route("/{id}/taches", name="taches_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, taches $tach)
    {
        $form = $this->createDeleteForm($tach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tach);
            $em->flush();
        }

        return $this->redirectToRoute('taches_index');
    }

    /**
     * Creates a form to delete a tach entity.
     *
     * @param taches $tach The tach entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(taches $tach)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('taches_delete', array('id' => $tach->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
