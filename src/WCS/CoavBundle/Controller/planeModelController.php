<?php

namespace WCS\CoavBundle\Controller;

use WCS\CoavBundle\Entity\planeModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Planemodel controller.
 *
 * @Route("planemodel")
 */
class planeModelController extends Controller
{
    /**
     * Lists all planeModel entities.
     *
     * @Route("/", name="planemodel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $planeModels = $em->getRepository('WCSCoavBundle:planeModel')->findAll();

        return $this->render('planemodel/index.html.twig', array(
            'planeModels' => $planeModels,
        ));
    }

    /**
     * Creates a new planeModel entity.
     *
     * @Route("/new", name="planemodel_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $planeModel = new Planemodel();
        $form = $this->createForm('WCS\CoavBundle\Form\planeModelType', $planeModel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($planeModel);
            $em->flush();

            return $this->redirectToRoute('planemodel_show', array('id' => $planeModel->getId()));
        }

        return $this->render('planemodel/new.html.twig', array(
            'planeModel' => $planeModel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a planeModel entity.
     *
     * @Route("/{id}", name="planemodel_show")
     * @Method("GET")
     */
    public function showAction(planeModel $planeModel)
    {
        $deleteForm = $this->createDeleteForm($planeModel);

        return $this->render('planemodel/show.html.twig', array(
            'planeModel' => $planeModel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing planeModel entity.
     *
     * @Route("/{id}/edit", name="planemodel_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, planeModel $planeModel)
    {
        $deleteForm = $this->createDeleteForm($planeModel);
        $editForm = $this->createForm('WCS\CoavBundle\Form\planeModelType', $planeModel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('planemodel_edit', array('id' => $planeModel->getId()));
        }

        return $this->render('planemodel/edit.html.twig', array(
            'planeModel' => $planeModel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a planeModel entity.
     *
     * @Route("/{id}", name="planemodel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, planeModel $planeModel)
    {
        $form = $this->createDeleteForm($planeModel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($planeModel);
            $em->flush();
        }

        return $this->redirectToRoute('planemodel_index');
    }

    /**
     * Creates a form to delete a planeModel entity.
     *
     * @param planeModel $planeModel The planeModel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(planeModel $planeModel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('planemodel_delete', array('id' => $planeModel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
